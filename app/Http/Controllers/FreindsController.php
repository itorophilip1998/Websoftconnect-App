<?php

namespace App\Http\Controllers;

use App\Chat;
use App\User;
use App\Freinds;
use App\Profile;
use App\Notification;

use App\SuggestedFriends;
use App\ChatNotification  ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\Notification as Notify;

class FreindsController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Profile $profile)
    {

        $request=Notification::where('title','sent you a friend request')
        ->with('user.profiles')
        ->where('owner_id',Auth::user()->id)
        ->get();
        $freinds=Freinds::where('friend_id',Auth::user()->id)->with('user.profiles','user.chatNotify')->get()->map(function ($user)
        {

            $user->isOnline = $user->isOnline();  
            return $user;
        });
         

        $suggested=SuggestedFriends::where('friend_id',Auth::user()->id)
        ->with('user.profiles')
        ->get();  

        return response()->json(['freinds'=>$freinds,'request'=>$request,'suggested'=>$suggested], 200);

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
        $freind=Notification::where('user_id',Auth::user()->id)
        ->where('owner_id',$request->id)
        ->where('title','sent you a friend request')
        ->first();
        $oldFriend=Freinds::where('friend_id',Auth::user()->id)
        ->where('user_id',$request->id)->first();
        $sent=Notification::where('owner_id',Auth::user()->id)
        ->where('user_id',$request->id)
        ->where('title','sent you a friend request')
        ->first();
        $querryData=SuggestedFriends::where('user_id',$request->id)
        ->where('friend_id',Auth::user()->id);
        if ($querryData) {
            $querryData->delete();
        }

   if ($oldFriend) {
            $f= Freinds::find($oldFriend['id']);
           $data= Freinds::where('user_id',$f->pluck('friend_id')->first());
           $data2= Freinds::where('friend_id',$f->pluck('user_id')->first());
           if($data) Freinds::find($data->pluck('id')->first())->delete();
           if($data2) Freinds::find($data2->pluck('id')->first())->delete();
            event(new  Notify($request->all(),'no request'));
            return response()->json(['message'=>'No request'], 200);
      }
      elseif ($sent)
      {
          if ($sent['owner_id']===Auth::user()->id) {
            Freinds::create([
                'friend_id'=>$sent['user_id'],
                'user_id'=>$sent['owner_id'],
            ]);
             Freinds::create([
                'friend_id'=>$sent['owner_id'],
                'user_id'=>$sent['user_id'],
            ]);
            $n= Notification::find($sent['id']);
            if($n) $n->delete();
            event(new  Notify($request->all(),'Accepted request'));
            return response()->json(['message'=>'friend'], 200);

          }else {
            dd("error");
          }
      }
      elseif ($freind) {
             $freind->delete();
             event(new  Notify($request->all(),'no request'));
             return response()->json(['message'=>'No request'], 200);
      }
    else {
            Notification::create([
                'owner_id'=>$request->id,
                'user_id'=>Auth::user()->id,
                'data_id'=>$request->id,
                'title'=>'sent you a friend request',
                'status'=>null,
                'type'=>'freind request',
            ]);
            event(new  Notify($request->all(),'freind request'));
            return response()->json(['message'=>'requested'], 200);

        }
       }

    /**
     * Display the specified resource.
     *
     * @param  \App\Freinds  $freinds
     * @return \Illuminate\Http\Response
     */
    public function show($freinds)
    {
        $freind=Notification::where('user_id',Auth::user()->id)
        ->where('owner_id',$freinds)
        ->where('title','sent you a friend request')
        ->first();
        $sent=Notification::where('owner_id',Auth::user()->id)
        ->where('user_id',$freinds)
        ->where('title','sent you a friend request')
        ->first();

        $f=Freinds::where('friend_id',Auth::user()->id)
        ->where('user_id',$freinds)->first();
      if ($f) {
            return response()->json(['message'=>'friend'], 200);
        }
        elseif ($sent)
        {
            return response()->json(['message'=>'accept'], 200);

        }
        else{
            if ($freind) {

                return response()->json(['message'=>'requested'], 200);
            }
            else{
                return response()->json(['message'=>'No request'], 200);
            }

        }



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Freinds  $freinds
     * @return \Illuminate\Http\Response
     */
    public function edit(Freinds $freinds)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Freinds  $freinds
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$freinds)
    {

        Freinds::create([
            'friend_id'=>Auth::user()->id,
            'user_id'=>$freinds,
        ]);
         Freinds::create([
            'friend_id'=>$freinds,
            'user_id'=>Auth::user()->id,
        ]);
        $f= Freinds::find($freinds);
        $n= Notification::find($request->item['id']);
        if($f) $f->delete();
        if($n) $n->delete();
        event(new  Notify($request->all(),'Accepted request'));
        return response()->json(['message'=>"Accepted Request"], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Freinds  $freinds
     * @return \Illuminate\Http\Response
     */
    public function destroy($freinds)
    {
           $f= Freinds::find($freinds);
           $data= Freinds::where('user_id',$f->pluck('friend_id')->first());
           $data2= Freinds::where('friend_id',$f->pluck('user_id')->first());
           if($data) Freinds::find($data->pluck('id')->first())->delete();
           if($data2) Freinds::find($data2->pluck('id')->first())->delete();

           $n= Notification::find($freinds);
            if($n) $n->delete();
             event(new  Notify('No Request','Accept Deleted'));

    }
}
