<?php

namespace App\Http\Controllers;

use App\SuggestedFriends;
use Illuminate\Http\Request;

class SuggestedFriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SuggestedFriends $data)
    {
      return $data->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SuggestedFriends  $suggestedFriends
     * @return \Illuminate\Http\Response
     */
    public function show(SuggestedFriends $suggestedFriends)
    {
        //
    }


}
