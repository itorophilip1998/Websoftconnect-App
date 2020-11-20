<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Events\Notification as Notify;


class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $all= Notification::where('owner_id',Auth::user()->id)
      ->where('user_id','<>',Auth::user()->id)
      ->with('user.profiles')->latest()->get(); 
       $unSeen= Notification::where('owner_id',Auth::user()->id)
       ->where('user_id','<>',Auth::user()->id)
      ->where('status',NULL)->with('user.profiles')->latest()->get();
      $data=[
          'all'=>$all,
          'unSeen'=>$unSeen,
          'authUser'=>User::where('id',Auth::user()->id)->with('profiles')->first()];
      return response()->json($data,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $notify=Notification::where('status',Null)
        ->where('owner_id',Auth::user()->id)->get();
      if ($notify) {
        foreach ($notify as $n) {
            $n->status=now();
            $n->update();
         }
      }
         event(new  Notify($notify,'seen Notification'));
        return response()->json(['success'=>"Succesfully notify",$notify],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show($notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $notification)
    {
              $n=Notification::find($notification);
              $n->visited=true;
              $n->update();
              return response()->json(['success'=>"Succesfully notify",$n],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($notification)
    {
        Notification::where('owner_id',Auth::user()->id)->delete();
         return response()->json(['success'=>"Succesfully deleted"],200);

    }
}
