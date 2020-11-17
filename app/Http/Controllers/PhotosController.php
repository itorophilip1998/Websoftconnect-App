<?php

namespace App\Http\Controllers;

use App\Photos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function photos($id)
    {
        $photos=Photos::where('user_id',$id)->where('photo_type','<>','chat')->latest()->get();
        return response()->json($photos, 200);
    }
    public function chatsPhoto($id)
    {
        $photos=Photos::where('user_id',$id)->where('photo_type','=','chat')->latest()->get();
        return response()->json($photos, 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Photos  $photos
     * @return \Illuminate\Http\Response
     */
    public function photoById($id)
    {
        $photos=Photos::find($id)->first();
        return response()->json($photos, 200);
    }
    

}
