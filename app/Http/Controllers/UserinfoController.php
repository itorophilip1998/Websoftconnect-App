<?php

namespace App\Http\Controllers;

use App\Userinfo;
use App\User;
use Illuminate\Http\Request;

class UserinfoController extends Controller
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
        $id=auth()->user()->id;
        $userinfo=User::find($id);
        return response()->json($userinfo,200);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Userinfo  $userinfo
     * @return \Illuminate\Http\Response
     */
    public function show(Userinfo $userinfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Userinfo  $userinfo
     * @return \Illuminate\Http\Response
     */
    public function edit(Userinfo $userinfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Userinfo  $userinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Userinfo $userinfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Userinfo  $userinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Userinfo $userinfo)
    {
        //
    }

    public function notify($data){
        return  Notify::create([
                  'user_id'=>Auth::user()->id,
                  'type'=>'post',
                  'title'=>"Post Notification from $data Category",
                   'status'=>null
                  ]);
      }
}
