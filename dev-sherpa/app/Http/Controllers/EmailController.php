<?php

namespace Fully\Http\Controllers;

use Cartalyst\Support\Validator;
use Illuminate\Http\Request;

use Fully\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function send(Request $request)
    {//dd($request);
        $this->validate($request, [
            // 'name' => 'required',
            // 'email' => 'required|email',
            // 'package_title' => 'required',
            // 'number' => 'required|regex:/[0-9]/',
            // 'recaptcha1'=>'required',
        ]);
        
         if(($request['recaptcha1']) == null){
            return " The recaptcha field is required.";
        }else{
            $name = $request->name;
            $number = $request->number;
            $package_title = $request->package_title;
            $email = $request->email;
            
            $data = array(
                'name' => $name,
                'number' => $number,
                'package_title' => $package_title,
                'email' => $email,
            );
    
            Mail::send('emails.send', $data, function ($message) use ($data)
            {
                $message->from($data['email'], $data['name']);
                $message->subject('Get Free Quotes');
    
                $message->to('sherpaguide10@gmail.com');
            });
            
            return 'Message was successfully sent.'; 
        }
//        exit;
//        Session::flash( 'success', 'Message was successfully send.' );

//        return redirect('/');
    }

    public function bookTrip(Request $request)
    {
       $this->validate($request, [
            // 'name' => 'required',
            // 'email' => 'required|email',
            // 'package_title' => 'required',
            // 'number' => 'required|regex:/[0-9]/',
             //'recaptcha2'=>'required',
        ]);
//dd($request->ptitle);

        if(($request['recaptcha2']) == null){
            return " The recaptcha field is required.";
        }else{
            $name = $request->name;
            $number = $request->number;
            $ptitle = $request->ptitle;
            $email = $request->email;
    
            $data = array(
                'name' => $name,
                'number' => $number,
                'package_title' => $ptitle,
                'email' => $email,
            );
            Mail::send('emails.booktrip', $data, function ($message) use ($data)
            {
                $message->from($data['email'], $data['name']);
                $message->subject('Book Trip');
                $message->to('sherpaguide10@gmail.com');
            });
    
            return 'Message was successfully sent.';
        }
//        Session::flash( 'success', 'Message was successfully sent.' );
//
//        return redirect('/');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
