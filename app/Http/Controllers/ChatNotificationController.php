<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChatNotification  ;
use Illuminate\Support\Facades\Auth;

class ChatNotificationController extends Controller
{

    public function show($id)
    {
       $notify= ChatNotification::where('user_id',$id)
        ->where('friend_id',Auth::user()->id)->get();
        return response()->json(['notify'=>$notify],200);
    }

    public function index()
    {
       $notify= ChatNotification::where('user_id',Auth::user()->id)
       ->where('visited',false)->get();
        return response()->json(['notify'=>$notify],200);
    }
}
