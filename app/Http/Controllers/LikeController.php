<?php

namespace App\Http\Controllers;

use App\Like;
use App\Love;
use App\Post;
use App\User;
use App\Laugh;
use App\Events\Notification;
use Illuminate\Http\Request;
use App\Notification as Notify;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
      $users=User::all();
      $love=Love::where('post_id',$request->post_id)->where('user_id',Auth::user()->id);
      $like=Like::where('post_id',$request->post_id)->where('user_id',Auth::user()->id);
      $laugh=Laugh::where('post_id',$request->post_id)->where('user_id',Auth::user()->id);
      $post=Post::where('id',$request->post_id);
      if ($like->first()) {
        $like->delete();
        event(new  Notification(["unliked"],'unliked'));
      }
      elseif ($love->first()) {
        $love->delete();
        event(new  Notification(["unloved"],'unloved'));
        $newLike=new Like();
        $newLike->user_id=Auth::user()->id;
        $newLike->post_id=$request->post_id;
        $newLike->islike= $request->islike;
        $newLike->save();
         event(new  Notification( $request->all(),'liked'));
         foreach ($users as  $user) {
            $this->notify('liked',$post->pluck('id')->first(),$user->id);
         }
      }
      elseif ($laugh->first()) {
        $laugh->delete();
        event(new  Notification(["unreacted"],'unreacted'));
        $newLike=new Like();
        $newLike->user_id=Auth::user()->id;
        $newLike->post_id=$request->post_id;
        $newLike->islike= $request->islike;
        $newLike->save();
         event(new  Notification( $request->all(),'liked'));
         foreach ($users as  $user) {
            $this->notify('liked',$post->pluck('id')->first(),$user->id);
         }
      }
         else {
            $newLike=new Like();
            $newLike->user_id=Auth::user()->id;
            $newLike->post_id=$request->post_id;
            $newLike->islike= $request->islike;
            $newLike->save();
             event(new  Notification( $request->all(),'liked'));
             foreach ($users as  $user) {
                $this->notify('liked',$post->pluck('id')->first(),$user->id);
             }
         }

}

    /**
     * Display the specified resource.
     *
     * @param  \App\ActionBox  $actionBox
     * @return \Illuminate\Http\Response
     */
    public function show($like)
    {
       $likes=Like::where('post_id',$like)->with('user.profiles')->get();
       return response()->json($likes,200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ActionBox  $actionBox
     * @return \Illuminate\Http\Response
     */
    public function edit($likes)
    {
        $like=Auth::user()->likes()->where('post_id',$likes)->first();
       return response()->json($like,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ActionBox  $actionBox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$like)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ActionBox  $actionBox
     * @return \Illuminate\Http\Response
     */
    public function destroy($like)
    {
        $likes=Like::where('post_id',$like);
        event(new  Notification(["unliked"],'unliked'));
        $likes->delete();
        return response()->json(['success'=>"Succesfully deleted",$likes],200);

    }
    public function notify($data,$id,$owner_id){
        return  Notify::create([
                  'user_id'=>Auth::user()->id,
                  'type'=>$data,
                  'title'=>"$data a post",
                  'status'=>null,
                  'data_id'=>$id,
                  'owner_id'=>$owner_id
            ]);
      }

}
