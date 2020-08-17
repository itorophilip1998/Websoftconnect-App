<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;



class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment=Comment::latest()->with('user.profiles')->get();
        return response()->json($comment,200);
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
    //    dd( $request->all());
                $id=auth()->user()->id;
                $comment=new Comment();
                $comment->user_id=$id;
                $comment->post_id=$request->post_id;
                if($request->has('comment') && $request->comment !=null){
                    $comment->comment=$request->comment;
                  }
                if($request->hasFile('picture') && $request->picture !=null){
                    $imagePath=request('picture')->store("pictures",'public');
                    $image=Image::make(public_path("storage/{$imagePath}"))->resize(800, 800);
                    $image->fit(1200,1300);
                    $image->save();
                    $comment->picture=$imagePath;
                  }
                  if($request->comment !=null || $request->picture !=null){
                  $comment->save();
                  }

                return response()->json(['success'=>"Succesfully Commented",$comment],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($comment)
    {
        $comment=Comment::where('post_id',$comment)->latest()->with('user.profiles')->get();
        return response()->json($comment,200);
    }
    public function getComment($id)
    {
        $comment=Comment::where('id',$id)->get();
        return response()->json($comment,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit($comment)
    {
        $comments=Comment::where('id',$comment)->get();
        return response()->json($comments,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $comment) {
        $id=auth()->user()->id;
        $comment=Comment::find($comment);
        $comment->user_id=$id;
        $comment->post_id=$request->post_id;
        if($request->has('comment') && $request->comment !=null){
            $comment->comment=$request->comment;
          }
        if($request->hasFile('picture') && $request->picture !=null){
            $imagePath=request('picture')->store("pictures",'public');
            $image=Image::make(public_path("storage/{$imagePath}"))->resize(800, 800);
            $image->fit(1200,1300);
            $image->save();
            $comment->picture=$imagePath;
          }
          if($request->comment !=null || $request->picture !=null || $request->picture !='' || $request->comment !=''){
          $comment->update();
          }
        return response()->json(['success'=>"Succesfully Commented",$comment],200);

      }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($comment)
    {
        $post=Comment::findOrfail($comment);
        $post->delete();
        return response()->json(['success'=>'Successfully Deleted',$post],200);
    }
}
