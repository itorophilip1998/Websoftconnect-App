<?php

namespace App\Http\Controllers;
use App\Video; 
use App\viewers;
use Illuminate\Http\Request;
use App\Events\Notification;

class ViewersController extends Controller
{

 
  
    public function store(Request $request)
    {
        $viewers= viewers::where('video_id',$request->video_id)
        ->where('user_id',$request->user_id)->first(); 
        if ( $viewers) {
            dd("no need");  
        }
       $views=viewers::create([
            'user_id'=>$request->user_id,
            'viewer_id'=>$request->viewer_id,
            'video_id'=>$request->video_id
        ]);
        event(new  Notification($views,'Views'));
        if($views){
           return response()->json(['message'=>'You viewed'], 200); 
        }
    }

    public function show($video_id,$user_id)
    {
        $viewers= viewers::where('video_id',$video_id)
       ->where('user_id',$user_id) 
       ->with('videos')->get();  
       return response()->json(['viewers'=>$viewers], 200);  
    } 
}
