<?php

namespace App\Http\Controllers;

use App\Chat;
use App\User;
use App\Follow;

use App\Photos;
use App\Mail\ChatMail;
use App\Events\Notification;
// use App\Events\Typing;
use Illuminate\Http\Request;
use App\Notification as Notify;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{

    public function typing(Request $data){
        broadcast(new  Notification($data->all(),'typing'));
    }
    public function IMG(){
        $img= Chat::all()->last()->id;
        if ($img) {
         return $img+1;
        }
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return response()->json($user);
    }
    public function friendslist()
    {
        // $follow = Follow::where('user_id',auth()->user()->id)->pl();

        $users=User::where('id','<>',Auth::user()->id)
        ->with('profiles','profiles.followers','following')
        ->get()->map(function ($user)
        {
            $user->isOnline = $user->isOnline();
            return $user;
        });

        return response()->json($users,200);

    }




/**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show($chat)
    {
        $chats = auth()->user()->chats()->where(function($q) use($chat)
        {   $q->where('user_id',auth()->user()->id);
            $q->where('friend_id',$chat);
        })->orWhere(function($q) use($chat)
        {   $q->where('friend_id',auth()->user()->id);
            $q->where('user_id',$chat);
        })->with('user.profiles')->get();
        return response()->json($chats,200);
    }

    public function store(Request $request)
    {
        $chats=new Chat();
        $chats->friend_id=$request->friend_id;
        $chats->user_id=Auth::user()->id;
        $chats->owner_id=Auth::user()->id;
        if($request->has('messages') && $request->messages != null){
            $chats->messages=$request->messages;
        }
        if($request->hasFile('picture')  && $request->picture != 'null' && $request->picture != null ){
            $IMG=$request->file('picture')->getClientOriginalName();
            $imagePath=request('picture')->storeAs("Chats",$this->IMG().$IMG);
           $image=Image::make(public_path("storage/{$imagePath}"));
           $image->save();
            $chats->picture=URL::to('/').'/storage/'.$imagePath;
            Photos::create([
                'user_id'=>Auth::user()->id,
                'photo_name'=>URL::to('/').'/storage/'.$imagePath,
                'photo_type'=>"chat",
                'photo_url'=>$imagePath
               ]);
        }

        if($request->picture || $request->messages)
        {
          $chats->save();
          event(new  Notification($chats,'chat'));
          $id=$chats->friend_id;
          $chat = auth()->user()->chats()->where(function($q) use($id)
          {   $q->where('user_id',auth()->user()->id);
              $q->where('friend_id',$id);
          })->orWhere(function($q) use($id)
          {   $q->where('friend_id',auth()->user()->id);
              $q->where('user_id',$id);
          })->with('user.profiles')->latest()->first();
          return response()->json($chat,200);
        }
        // $friendname=User::where('id',$request->friend_id)->pluck('email')->first();
        // $friendemail=User::where('id',$request->friend_id)->pluck('email')->first();

        // try{
        //     // Mail::to($friendemail)->send(new ChatMail($friendname));
        //     // Mail::to(Auth::user()->email)->send(new ChatMail(Auth::user()->name));
        //    }catch(\Exception $error)
        //    {
        //     //  Do nothing here..
        //    }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $chat)
    {
        $chats=Chat::find($chat);
        $chats->friend_id=$request->friend_id;
        $chats->user_id=Auth::user()->id;
        $chats->owner_id=Auth::user()->id;

        if($request->has('messages') && $request->messages != null){
            $chats->messages=$request->messages;
        }
        if($request->hasFile('picture')  && $request->picture != 'null' && $request->picture != null ){
            $IMG=$request->file('picture')->getClientOriginalName();
            $imagePath=request('picture')->storeAs("Chats",$this->IMG().$IMG);
           $image=Image::make(public_path("storage/{$imagePath}"));
           $image->save();
             $chats->picture=$imagePath;
             $chats->picture=URL::to('/').'/storage/'.$imagePath;
             Photos::create([
                 'user_id'=>Auth::user()->id,
                 'photo_name'=>URL::to('/').'/storage/'.$imagePath,
                 'photo_type'=>"chat",
                 'photo_url'=>$imagePath
                ]);
        }
        if($request['picture'] || $request['messages'])
        {
        $chats->save();
        event(new  Notification($chats,'chat'));
        return response()->json(['success'=>'Successfully Updated',$chats],200);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy($chat)
    {   $data=Chat::find($chat);
        $data->delete();
        return response()->json(['success'=>'Successfully Deleted!'],200);
    }
    public function photo($imagePath){
        return  Photos::create([
              'user_id'=>Auth::user()->id,
              'photo_name'=>URL::to('/').'/storage/'.$imagePath,
              'photo_type'=>"post",
              'photo_url'=>$imagePath,
             ]);
      }


}
