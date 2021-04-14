<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Events\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{

    public function index(Reply $reply)
    {
       return $reply->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'freind_id'=>'required',
            'comment_id'=>'required',
            ]);
       if ($request->reply=='' || $request->picture=='') {
            $data=Reply::create([
                'user_id'=>Auth::user()->id,
                'freind_id'=>$request->freind_id,
                'comment_id'=>$request->comment_id,
                'message'=>$request->message,
            ]);
        if($data){
            event(new  Notification($data,'reply'));
         return response()->json(['data'=>$data], 200);
       }

    }
}



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
        $request->validate([
            'freind_id'=>'required',
            'comment_id'=>'required',
            ]);
       if ($request->reply=='' || $request->picture=='') {
            $data=$reply->update([
                'user_id'=>Auth::user()->id,
                'freind_id'=>$request->freind_id,
                'comment_id'=>$request->comment_id,
                'message'=>$request->message
            ]);
        if($data){
            event(new  Notification($data,'reply'));
         return response()->json(['data'=>$data], 200);
       }

    }
  }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        $reply->delete();

    }
}
