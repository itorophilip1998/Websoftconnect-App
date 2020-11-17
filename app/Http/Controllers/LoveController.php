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


class LoveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $like = Post::all();
       return response()->json($like,200);
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
            $newLike=new Love();
            $newLike->user_id=Auth::user()->id;
            $newLike->post_id=$request->post_id;
            $newLike->islove= $request->islove;
            $newLike->save();
             event(new  Notification( $request->all(),'loved'));
             foreach ($users as  $user) {
              $this->notify('Loved',$post->pluck('id')->first(),$user->id);
           }
          }
          elseif ($love->first()) {
            $love->delete();
            event(new  Notification(["unloved"],'unloved'));
          }
          elseif ($laugh->first()) {
            $laugh->delete();
            event(new  Notification(["unreacted"],'unreacted'));
            $newLike=new Love();
            $newLike->user_id=Auth::user()->id;
            $newLike->post_id=$request->post_id;
            $newLike->islove= $request->islove;
            $newLike->save();
             event(new  Notification( $request->all(),'loved'));
             foreach ($users as  $user) {
              $this->notify('Loved',$post->pluck('id')->first(),$user->id);
           }
          }
         else {
            $newLike=new Love();
            $newLike->user_id=Auth::user()->id;
            $newLike->post_id=$request->post_id;
            $newLike->islove= $request->islove;
            $newLike->save();
             event(new  Notification( $request->all(),'loved'));
             foreach ($users as  $user) {
              $this->notify('Loved',$post->pluck('id')->first(),$user->id);
           }
         }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ActionBox  $actionBox
     * @return \Illuminate\Http\Response
     */
    public function show($love)
    {
        $like=Love::where('post_id',$love)->with('user.profiles')->get();
        return response()->json($like,200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ActionBox  $actionBox
     * @return \Illuminate\Http\Response
     */
    public function edit(Love $actionBox)
    {
        //
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
        $likes=Love::where('post_id',$like);
        event(new  Notification(["unlikes"],'unlove'));
        $likes->delete();
        return response()->json(['success'=>"Succesfully deleted"],200);

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


