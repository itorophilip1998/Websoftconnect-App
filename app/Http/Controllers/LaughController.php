<?php

namespace App\Http\Controllers;

use App\Like;
use App\Love;
use App\Post;
use App\User;
use App\Laugh;
use Illuminate\Http\Request;
use App\Notification as Notify;
use App\Events\Notification;

use Illuminate\Support\Facades\Auth;

class LaughController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auth::user();
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
        $newLike=new Laugh();
        $newLike->user_id=Auth::user()->id;
        $newLike->post_id=$request->post_id;
        $newLike->islaugh= $request->islaugh;
        $newLike->save();
         event(new  Notification( $request->all(),'reacted'));
         foreach ($users as  $user) {
            $this->notify('reacted',$post->pluck('id')->first(),$user->id);
         }
      }
      elseif ($love->first()) {
        $love->delete();
        event(new  Notification(["unloved"],'unloved'));
        $newLike=new Laugh();
        $newLike->user_id=Auth::user()->id;
        $newLike->post_id=$request->post_id;
        $newLike->islaugh= $request->islaugh;
        $newLike->save();
         event(new  Notification( $request->all(),'reacted'));
         foreach ($users as  $user) {
            $this->notify('reacted',$post->pluck('id')->first(),$user->id);
         }
      }
      elseif ($laugh->first()) {
        $laugh->delete();
        event(new  Notification(["unreacted"],'unreacted'));
      }
      else {
        $newLike=new Laugh();
        $newLike->user_id=Auth::user()->id;
        $newLike->post_id=$request->post_id;
        $newLike->islaugh= $request->islaugh;
        $newLike->save();
         event(new  Notification( $request->all(),'reacted'));
         foreach ($users as  $user) {
            $this->notify('reacted',$post->pluck('id')->first(),$user->id);
         }
      }



}

    /**
     * Display the specified resource.
     *
     * @param  \App\ActionBox  $actionBox
     * @return \Illuminate\Http\Response
     */
    public function show($laugh)
    {
       $laughs=Laugh::where('post_id',$laugh)->with('user.profiles')->get();
       return response()->json($laughs,200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ActionBox  $actionBox
     * @return \Illuminate\Http\Response
     */
    public function edit($laugh)
    {
        $laughs=Auth::user()->laugh()->where('post_id',$laugh)->first();
       return response()->json($laughs,200);
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
    public function destroy($laugh)
    {
        $laughs=Laugh::where('post_id',$laugh);
        event(new  Notification(["unliked"],'unliked'));
        $laughs->delete();
        return response()->json(['success'=>"Succesfully deleted",$laughs],200);

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
