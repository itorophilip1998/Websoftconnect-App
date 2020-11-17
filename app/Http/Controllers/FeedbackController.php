<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function addMail(Request $data){
     $feedback= Feedback::create([
            'email'=>$data->email
      ]);
      if ($feedback) {
        $data->session()->flash('message2',"Successfully Subscribed!");
       return redirect('/welcome#feedback');
      }
    }
 

}
