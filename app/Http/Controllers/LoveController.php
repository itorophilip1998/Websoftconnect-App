<?php

namespace App\Http\Controllers;

use App\Like;
use App\Love;
use App\Post;
use App\User;
use Illuminate\Http\Request;
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
                $post_id=$request['post_id'];
                $is_like=$request['islove'] === 'true';
                $update=false;
                $post=Post::find($post_id);
                  if(!$post)
                  {
                      return null;
                  }
                $like=Auth::user()->loves()->where('post_id', $post_id)->first();
                $love=Auth::user()->likes()->where('post_id', $post_id)->first();
                if($love)
                {$love->delete();}

                    if($like)
                    {
                        $already_Like= $like->islove;
                        $update=true;
                        if($already_Like==$is_like)
                        {
                            $like->delete();
                            return null;

                        }
                    }
                        else {
                            $like=new Love();
                        }
                        $like->user_id=Auth::user()->id;
                        $like->post_id=$request->post_id;
                        $like->islove= $request->islove;

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
        $likes->delete();
        return response()->json(['success'=>"Succesfully deleted",$likes],200);

    }

}
