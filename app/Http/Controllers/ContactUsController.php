<?php

namespace App\Http\Controllers;
use App\ContactUs;
use Illuminate\Http\Request;
use App\Notification as Notify;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=ContactUs::latest()->paginate(10);
        return response()->json($data,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'phone'=>'nullable',
            'message'=>'required',
        ]);
        ContactUs::create($request->all());
        $request->session()->flash('message',"We have recieved your request, we will look up to it");
        $request->session()->flash('user',"$request->first_name");
        return redirect('/contact_us#sct-form-contact');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function show($contactUs)
    {
        $data=ContactUs::find($contactUs);
        return response()->json($data,200);
    }


    public function destroy($contactUs)
    {
        $data=ContactUs::find($contactUs);
        $data->delete();
        return response()->json(['success'=>'Successfully Deleted'],200);

    } 
}
