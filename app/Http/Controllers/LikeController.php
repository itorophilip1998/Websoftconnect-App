<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use App\Love;
use App\User;
use Illuminate\Http\Request;
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
        $post_id=$request['post_id'];
        $is_like=$request['islike'] === 'true';
        $update=false;
        $check=false;
        $post=Post::find($post_id);
          if(!$post)
          {
              return null;
          }
        $love=Auth::user()->loves()->where('post_id', $post_id)->first();
        $like=Auth::user()->likes()->where('post_id', $post_id)->first();
        if($love)
        {$love->delete();}
            if($like)
              {
                $already_Like= $like->islike;
                $update=true;
                if($already_Like==$is_like)
                {
                    $like->delete();
                    $check=true;
                    return null;
                }
            }
            else{
                $like=new Like();
                $like->user_id=Auth::user()->id;
                $like->post_id=$request->post_id;
                $like->islike= $request->islike;
               }

                if ($update) {
                    $like->update();
                return response()->json(['success'=>"Succesfully Liked",$like],200);
                }
                else{
                $like->save();
                return response()->json(['success'=>"Succesfully Liked",$like],200);
                }
                return null;


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
        $likes->delete();
        return response()->json(['success'=>"Succesfully deleted",$likes],200);

    }

}
