<?php

namespace App\Http\Controllers;

use App\Freinds;
use App\Notification;
use App\Notification as Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreindsController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // dd($request->all());
        $freind=Notification::where('owner_id',Auth::user()->id)
        ->where('user_id',$request->id)
        ->where('title','sent you a friend request')
        ->first();
        $f=Freinds::where('friend_id',Auth::user()->id)
        ->where('user_id',$request->id)->first();

   if ($f) {
            if($f)  $f->delete();
            return response()->json(['message'=>'No request'], 200);
      }
      elseif ($freind) {
             $freind->delete();
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
        $freind=Notification::where('owner_id',Auth::user()->id)
        ->where('user_id',$freinds)
        ->where('title','sent you a friend request')
        ->first();
        $f=Freinds::where('friend_id',Auth::user()->id)
        ->where('user_id',$freinds)->first();
        if ($f) {
            return response()->json(['message'=>'friend'], 200);
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
        return response()->json(['message'=>"Accepted Request from"], 200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Freinds  $freinds
     * @return \Illuminate\Http\Response
     */
    public function destroy($freinds)
    {
        try {
           $n= Notification::find($freinds);
        //    $f= Freinds::find($freinds);
            if($n) $n->delete();
            // if($f) $f->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
