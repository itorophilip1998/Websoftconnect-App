<?php

namespace App\Http\Controllers;

use App\Chat;
use App\User;
use App\Photos;
use App\Mail\ChatMail;
use App\Events\Notification;
// use App\Events\Typing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{

    public function typing(Request $data){
        // dd($data->all());
        broadcast(new  Notification($data->all(),'typing'));
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
        $users=User::with('profiles')->get()->map(function ($user)
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
        })->with('user.profiles')->latest()->get();
        return response()->json($chats,200);
    }

    public function store(Request $request)
    {
        $chats=new Chat();
        $chats->friend_id=$request->friend_id;
        $chats->user_id=$request->user_id;
        if($request->has('messages') && $request->messages != null){
            $chats->messages=$request->messages;
        }
        if($request->hasFile('picture')  && $request->picture != 'null' && $request->picture != null ){
            $imagePath=$request->file('picture')->store("pictures",'public');
            $image=Image::make(public_path("storage/{$imagePath}"));
            $image->save();
            $chats->picture=$imagePath;
            Photos::create([
                'user_id'=>Auth::user()->id,
                'photo_name'=>URL::to('/').'/storage/'.$imagePath,
                'photo_type'=>"chat",
               ]);
        }

        if($request->picture != '' || $request->messages != '')
        {

        $chats->save();
        broadcast(new  Notification($chats,'chat'));

        return response()->json(['success'=>'Successfully Send',$chats],200);

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
        $chats->user_id=$request->user_id;
        if($request->has('messages') && $request->messages != null){
            $chats->messages=$request->messages;
        }
        if($request->hasFile('picture')  && $request->picture != 'null' && $request->picture != null ){
            $imagePath=$request->file('picture')->store("pictures",'public');
            $image=Image::make(public_path("storage/{$imagePath}"));
            $image->save();
             $chats->picture=$imagePath;
             Photos::create([
                'user_id'=>Auth::user()->id,
                'photo_name'=>URL::to('/').'/storage/'.$imagePath,
                'photo_type'=>"chat",
               ]);
        }
        if($request['picture'] != '' || $request['messages'] != '')
        {
        $chats->save();
        }
        return response()->json(['success'=>'Successfully Updated',$chats],200);

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
}

