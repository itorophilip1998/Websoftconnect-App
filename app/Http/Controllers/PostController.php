<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Photos;
use App\Profile;
use App\Events\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class PostController extends Controller
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
        // $post=Post::with('comments','likes','loves','user.profiles')->latest()->get();
        // return response()->json($post,200);

        $post=Post::with('comments','likes','loves','user.profiles')->latest()->get()->map(function ($user)
        {
            $user->isOnline = $user->isOnline();
            return $user;
        });
        return response()->json($post,200);
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
        $request->validate([
            'picture'=>'nullable|mimes:jpeg,bmp,png',
            'body'=>'required|string',
            'category'=>'required|string|max:20',
        ]);

        $post=new Post();
        $post->user_id =auth()->user()->id;
        $post->category= $request->category;
        if($request->has('body') && $request->body !=null){
        $post->body= $request->body;
        }
        else{
          $post->body= '';
        }

          if($request->hasFile('picture') && $request->picture !=null){
              $imagePath=request('picture')->store("pictures",'public');
              $image=Image::make(public_path("storage/{$imagePath}"))->resize(800, 800);
              $image->fit(1200,1300);
              $image->save();
              $post->picture=$imagePath;
              Photos::create([
                'user_id'=>Auth::user()->id,
                'photo_name'=>URL::to('/').'/storage/'.$imagePath,
                'photo_type'=>"post",
               ]);
          }else {
            $post->picture= '';
          }
          if($request->body !=null || $request->picture !=null || $request->picture !='' || $request->body !=''){
            $post->save();
            }
            event(new  Notification($post,'post'));
        return response()->json(['success'=>'Successfully Posted',$post],200);



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function getPost($id)
    {
        $post=Post::where('id',$id)->with('comments','likes','loves','user.profiles')
        ->latest()
        ->get()
        ->map(function ($user)
        {
            $user->isOnline = $user->isOnline();
            return $user;
        });
        return response()->json($post,200);
    }
    public function show($post)
    {
        $posts=Post::where('user_id',$post)->with('comments','likes','loves','user.profiles')->latest()->get();
        return response()->json($posts,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($post)
    {
            $posts=Post::where('id',$post)->get();
            return response()->json($posts,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post)
    {
        $request->validate([
            'picture'=>'nullable|mimes:jpeg,bmp,png,gif',
            'body'=>'required',
            'category'=>'required|string|max:20',
        ]);
        $posts=Post::find($post);
        $posts->user_id =auth()->user()->id;
         $posts->category= $request->category;
        if($request->has('body') && $request->body !=null){
            $posts->body= $request->body;
            }
            if($request->hasFile('picture') && $request->picture !=null){
                $imagePath=request('picture')->store("pictures",'public');
                $image=Image::make(public_path("storage/{$imagePath}"))->resize(800, 800);
                $image->fit(1200,1300);
                $image->save();
                $posts->picture=$imagePath;
                Photos::create([
                    'user_id'=>Auth::user()->id,
                    'photo_name'=>URL::to('/').'/storage/'.$imagePath,
                    'photo_type'=>"post",
                   ]);
            }
              if( $request->category !=null && $request->has('picture')  && $request->picture != '' && $request->picture != null ||  $request->body !=null)
                  {$posts->update();}

             return response()->json(['success'=>'Successfully Updated',$posts],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        $post=Post::findOrfail($post)->delete();
        return response()->json(['success'=>'Successfully Deleted',$post],200);
    }
}
