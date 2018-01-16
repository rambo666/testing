<?php

namespace Fully\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Fully\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class QuoteController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function process( Request $request )
    {
        $attributes = Input::all();
//         print_r(Input::all());

        $name = $attributes['name'];
        $number = $attributes['number'];
        $package_title = $attributes['package_title'];
        $email = $attributes['email'];

        $data = array(
            'name' => $name,
            'number' => $number,
            'package_title' => $package_title,
            'email' => $email,
        );

        $success_mail = Mail::send('emails.send', $data, function ($message) use ($data)
        {
            $message->from($data['email'], $data['name']);

            $message->to('ashish@view9.com.np');
        });

        if ( $success_mail ) {
            $message = "Message was successfully sent.";
            echo $message;
        }
        else{
            $message = "Message couldn't be sent.";
            echo $message;
        }
//        Session::flash( 'success', 'Message was successfully send.' );

        exit;

//        if ( Request::ajax() )
//        {
//            $data = Input::all();
//
//        }
    }
}
