<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use App\Photos;
use App\Comment;
use App\Events\Notification;
use Illuminate\Http\Request;
use App\Notification as Notify;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
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
               $users=User::all();
                $id=auth()->user()->id;
                $comment=new Comment();
                $comment->user_id=$id;
                $comment->post_id=$request->post_id;
                if($request->has('comment') && $request->comment !=null){

        $request->validate([
            'comment'=>'required',
            ]);
                    $comment->comment=$request->comment;
                  }
                if($request->hasFile('picture') && $request->picture !=null){
                    $request->validate([
                        'picture'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
                    ]);
                    $imagePath=request('picture')->store("pictures",'public');
                    $image=Image::make(public_path("storage/{$imagePath}")); 
                    $image->save();
                    $comment->picture=$imagePath;
                    Photos::create([
                        'user_id'=>Auth::user()->id,
                        'photo_name'=>URL::to('/').'/storage/'.$imagePath,
                        'photo_type'=>"comment",
                       ]);
                  }
                  if($request->comment !=null || $request->picture !=null){
                  $comment->save();
                 event(new  Notification(["New comment"],'comment'));
                 foreach ($users as  $user) {
                    $this->notify('Commented on a post',$request->id,$user->id);
                 }

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

        $users=User::all();
        $id=auth()->user()->id;
        $comment=Comment::find($comment);
        $comment->user_id=$id;
        $comment->post_id=$request->post_id;
        if($request->has('comment') && $request->comment !=null){
        $request->validate([
            'comment'=>'required',
            ]);
            $comment->comment=$request->comment;
          }
        if($request->hasFile('picture') && $request->picture !=null){
            $request->validate([
                'picture'=>'nullable|mimes:jpeg,png,jpg,gif'
                ]);
            $imagePath=request('picture')->store("pictures",'public');
            $image=Image::make(public_path("storage/{$imagePath}"));
            $image->save();
            $comment->picture=$imagePath;
            Photos::create([
                'user_id'=>Auth::user()->id,
                'photo_name'=>URL::to('/').'/storage/'.$imagePath,
                'photo_type'=>"comment",
               ]);
          }
          if($request->comment !=null || $request->picture !=null || $request->picture !='' || $request->comment !=''){
          $comment->update();
          event(new  Notification(["comment update"],'comment'));
          foreach ($users as  $user) {
            $this->notify('Updated a comment',$request->id,$user->id);
         }
          }
        return response()->json(['success'=>"Succesfully updated Commented",$comment],200);

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

    public function notify($data,$id,$owner_id){
        return  Notify::create([
                  'user_id'=>Auth::user()->id,
                  'type'=>'comment',
                  'title'=>"$data",
                   'status'=>null,
                   'data_id'=>$id,
                   'owner_id'=>$owner_id
                  ]);
      }
}
