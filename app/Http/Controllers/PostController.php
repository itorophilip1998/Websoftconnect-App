<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Photos;
use App\Notification as Notify;
use App\Profile;
use App\Events\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    public function IMG(){
        $img= Post::all()->last()->id;
        if ($img) {
         return $img+1;
        }
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

        $post=Post::with('comments','likes','loves','user.profiles','laugh')->latest()->get()->map(function ($user)
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
        $users=User::all();
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
              $IMG=$request->file('picture')->getClientOriginalName();
              $imagePath=request('picture')->storeAs("Posts",$this->IMG().$IMG);
              $image=Image::make(public_path("storage/{$imagePath}"));
              $image->save();
              $post->picture=URL::to('/').'/storage/'.$imagePath;
              $this->photo($imagePath);

          }else {
            $post->picture= '';
          }
          if($request->body !=null || $request->picture !=null || $request->picture !='' || $request->body !=''){
            $post->save();
            event(new  Notification($post,'post'));
            foreach ($users as  $user) {
                $this->notify('Posted',$post->id,$user->id);
             }

            return response()->json(['success'=>'Successfully Posted',$post],200);
            }
            else {
                return response()->json(['Error'=>'Can`t Update'],422);

            }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function getPost($id)
    {
        $post=Post::where('id',$id)->with('comments','likes','loves','user.profiles','laugh')
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
        $posts=Post::where('user_id',$post)->with('comments','likes','loves','user.profiles','laugh')->latest()->get();
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
        $users=User::all();
        $posts=Post::find($post);
        $posts->user_id =auth()->user()->id;
         $posts->category= $request->category;
        if($request->has('body') && $request->body !=null){
            $posts->body= $request->body;
            }
            if($request->hasFile('picture') && $request->picture !=null){
                $IMG=$request->file('picture')->getClientOriginalName();
                 $imagePath=request('picture')->storeAs("Posts",$this->IMG().$IMG);
                $image=Image::make(public_path("storage/{$imagePath}"));
                $image->save();
                $posts->picture=URL::to('/').'/storage/'.$imagePath;
                $this->photo($imagePath);
            }
            if($request->body !=null || $request->picture !=null || $request->picture !='' || $request->body !='')
               {
                    $posts->save();
                    event(new  Notification($post,'post'));
                    foreach ($users as  $user) {
                        $this->notify('Updated a post',$posts->id,$user->id);
                     }

                    return response()->json(['success'=>'Successfully Updated',$posts],200);
                }
                else {
                    return response()->json(['Error'=>'Can`t Update'],422);
                }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function deletePost(Request $post)
    {
        if($post["picture"]){
            $getMe=Photos::where('photo_name',$post["picture"])->pluck('photo_url')->first();
            Storage::delete($getMe);
            Photos::where('photo_name',$post["picture"])->delete();
        }
        Post::findOrfail($post["id"])->delete();
        return response()->json(['success'=>'Successfully Deleted'],200);
    }


    public function photo($imagePath){
      return  Photos::create([
            'user_id'=>Auth::user()->id,
            'photo_name'=>URL::to('/').'/storage/'.$imagePath,
            'photo_type'=>"post",
            'photo_url'=>$imagePath,
           ]);
    }
    public function notify($title,$id,$owner_id){
      return  Notify::create([
                'user_id'=>Auth::user()->id,
                'type'=>'post',
                'title'=>"$title",
                'status'=>null,
                'data_id'=>$id,
                'owner_id'=>$owner_id
                ]);
    }

}

