<?php

namespace App\Http\Controllers;
use App\ContactUs;
use Illuminate\Http\Request;

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
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'phone'=>'nullable',
            'message'=>'required',
        ]);
        ContactUs::create($request->all());
        return response()->json(['success'=>'Successfully Posted',$request->all()],200);

        // $data=new ContactUs();
        // $data->first_name=$request->first_name;
        // $data->last_name=$request->last_name;
        // $data->email=$request->email;
        // $data->phone=$request->phone;
        // $data->message=$request->message;
        // $data
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
