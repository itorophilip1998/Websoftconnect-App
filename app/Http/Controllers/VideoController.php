<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use App\Notification as Notify;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class VideoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video= Video::with('user.profiles')->latest()->get();
        return response()->json(['video'=>$video], 200);
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
        // dd($request->file('name'));
       $request->validate([
            'name'=>"mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040|required",
            'category'=>"required"
       ]);
    $IMG=$request->file('name')->getClientOriginalName();
    $imagePath=request('name')->storeAs("video",$IMG);
        $video=Video::create([
                'name'=>URL::to('/').'/storage/'.$imagePath,
                'user_id'=>Auth::user()->id,
                'description'=>$request->description,
                'category'=>$request->category
            ]);
        if($video)
        {
            return response()->json(['video'=>$video,'message'=>"Successfully Uploaded a video"],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
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
