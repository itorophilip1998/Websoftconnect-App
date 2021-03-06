<?php

namespace App\Http\Controllers;

use App\User;
use App\Photos;
use App\Freinds;
use App\Profile;
use App\SuggestedFriends;
use App\Events\Notification;
use Illuminate\Http\Request;
use App\Notification as Notify;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check())
        {

            $userProfile=User::where('id',Auth::user()->id)->with('profiles','profiles.followers.profiles','following')->get();
            return response()->json($userProfile,200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show($profile)
    {
    //    $user = User::where('name',$profile)
    //      ->with('profiles')->get();
          $first_name=Profile::where('first_name',$profile)
          ->pluck('id')->first();
         $user = User::where(function($q) use($profile)
         {
             $q->where('name',$profile);
         })->orWhere(function($q) use($first_name)
         {
             $q->where('id', $first_name);
         })->with('profiles')->get();
        return response()->json($user);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $profile)
    {
        $profiles=Profile::findorfail($profile);
        $profiles->user_id= auth()->user()->id;

        if($request->has('first_name') && $request->first_name != null){
            $profiles->first_name=$request->first_name;
            $request->validate([
                'first_name'=>'nullable|max:25'
                ]);
            $profiles->save();

        }
        if($request->has('last_name') && $request->last_name != null){
            $request->validate([
                'first_name'=>'nullable|max:25'
                ]);
            $profiles->last_name=$request->last_name;
            $profiles->save();
        }
        if($request->has('phone')  && $request->phone != null){
            $request->validate([
                'phone'=>'nullable|max:20'
                ]);
                if(strlen($request->phone) <= 11)
                {
                    $profiles->phone=$request->code.$request->phone;
                    $profiles->save();
                }
        }
        if($request->has('dob') && $request->dob != null){
            $profiles->dob=$request->dob;
            $profiles->save();
        }
        if($request->has('gender') && $request->gender != null){
            $request->validate([
                'gender'=>'nullable|max:10'
                ]);
            $profiles->gender=$request->gender;
            $profiles->save();
        }
        if($request->has('field')  && $request->field != null){
            $request->validate([
                'field'=>'nullable|max:20'
                ]);
            $profiles->field=$request->field;
            $profiles->save();

            $findId= Auth::user()->id;
            $check= Profile::where('id',$findId)->pluck('field')[0];
            $users=Profile::where('id','<>',$findId)
            ->where('field',$check)
            ->get();

            if ($users) {
                foreach ($users as $user) {
                    $querryData=SuggestedFriends::where('user_id','<>',$user->id)
                    ->where('friend_id','<>',$findId); 
                    if ($querryData->get()) {
                        SuggestedFriends::create([
                            'user_id'=> $user->id,
                            'friend_id'=> $findId,
                         ]);
                    }
                    else{
                        $querryData->delete();
                        SuggestedFriends::create([
                            'user_id'=> $user->id,
                            'friend_id'=> $findId,
                         ]);
                    }

                }
            }

        }

            if($request->has('status') && $request->status != null){
                $request->validate([
                    'status'=>'nullable|max:300'
                    ]);
                $profiles->status=$request->status;
                $profiles->save();
            }
        if($request->has('website')  && $request->website != null){
            $profiles->website=$request->website;
            $request->photo = 'null';
            $profiles->save();

        }

        if($request->has('country')  && $request->country != null){
            $profiles->country=$request->country;
            $request->photo = 'null';
            $profiles->save();

        }
        if($request->has('city')  && $request->city != null){
            $profiles->city=$request->city;
            $request->photo = 'null';
            $profiles->save();


        }
        if($request->hasFile('photo')  && $request->photo != 'null' && $request->photo != null ){
            $imagePath=$request->file('photo')->store("photos",'public');
            $image=Image::make(public_path("storage/{$imagePath}"));
            $image->save();
            $profiles->photo=URL::to('/').'/storage/'.$imagePath;
            $profiles->save();
            Photos::create([
             'user_id'=>Auth::user()->id,
             'photo_name'=>URL::to('/').'/storage/'.$imagePath,
             'photo_type'=>"profile",
            ]);
        }

        $users=User::where('field',$request->field);
        event(new  Notification($profiles,'profiles'));
        foreach ($users as  $user) {
            $this->notify($user->id);
         }

        return response()->json(['success'=>'Successfully Updated',$profiles],200);
    }

    public function bladeUpdate(Request $request)
    {

        // dd($request->all());
        $profiles=Profile::findorfail(auth()->user()->id);
        $profiles->user_id= auth()->user()->id;
        if($request->has('first_name') && $request->first_name != null){
            $profiles->first_name=$request->first_name;
            $request->validate([
                'first_name'=>'nullable|max:25'
                ]);
            $profiles->save();

        }
        if($request->has('last_name') && $request->last_name != null){
            $request->validate([
                'first_name'=>'nullable|max:25'
                ]);
            $profiles->last_name=$request->last_name;
            $profiles->save();
        }
        if($request->has('phone')  && $request->phone != null){
            $request->validate([
                'phone'=>'nullable|max:20'
                ]);
                if(strlen($request->phone) <= 11)
                {
                    $profiles->phone=$request->code.$request->phone;
                    $profiles->save();
                }
        }
        if($request->has('dob') && $request->dob != null){
            $profiles->dob=$request->dob;
            $profiles->save();
        }
        if($request->has('gender') && $request->gender != null){
            $request->validate([
                'gender'=>'nullable|max:10'
                ]);
            $profiles->gender=$request->gender;
            $profiles->save();
        }
        if($request->has('field')  && $request->field != null){
            $request->validate([
                'field'=>'nullable|max:20'
                ]);
            $profiles->field=$request->field;
            $profiles->save();

            $users=Profile::where('field',Profile::where('id',Auth::user()->id)->pluck('field')[0]);
           foreach ($users as $key => $user) {
            SuggestedFriends::create([
                'user_id'=>Auth::user()->id,
                'friend_id'=>$user->id,
            ]);
           }
        }

            if($request->has('status') && $request->status != null){
                $request->validate([
                    'status'=>'nullable|max:300'
                    ]);
                $profiles->status=$request->status;
                $profiles->save();
            }
        if($request->has('website')  && $request->website != null){
            $profiles->website=$request->website;
            $request->photo = 'null';
            $profiles->save();
        }

        if($request->has('country')  && $request->country != null){
            $profiles->country=$request->country;
            $request->photo = 'null';
            $profiles->save();

        }
        if($request->has('city')  && $request->city != null){
            $profiles->city=$request->city;
            $request->photo = 'null';
            $profiles->save();

        }
        if($request->hasFile('photo')){
            $imagePath=$request->file('photo')->store("photos",'public');
            $image=Image::make(public_path("storage/{$imagePath}"));
            $image->save();
            $profiles->photo=URL::to('/').'/storage/'.$imagePath;
            $profiles->save();

            Photos::create([
             'user_id'=>Auth::user()->id,
             'photo_name'=>URL::to('/').'/storage/'.$imagePath,
             'photo_type'=>"profile",
            ]);
        }

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
    public function notify($data_id){
        return  Notify::create([
                  'user_id'=>Auth::user()->id,
                  'type'=>'profile',
                  'title'=>"Updated Profile",
                   'status'=>null,
                   'data_id'=>Auth::user()->id,
                    'owner_id'=>$data_id
                  ]);
      }



}
