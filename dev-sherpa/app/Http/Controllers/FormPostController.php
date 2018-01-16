<?php

namespace Fully\Http\Controllers;

use Illuminate\Http\Request;

use Fully\Services\Mailer;
use Fully\Models\FormPost;

use View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Validator;
use Redirect;

/**
 * Class FormPostController.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class FormPostController extends Controller
{
    protected $formPost;

    public function __construct(FormPost $formPost)
    {
        $this->formPost = $formPost;
    }

    public function getContact()
    {
        // TESTIMONIAL
        $testimonials = DB::table('testimonials')->get();
        View::share('testimonials', $testimonials);

        /**
         * FOOTER
         */
        // DESTINATIONS
        $footer_destinations = DB::table('destinations')->take(5)->select('title', 'slug')->get();
        View::share('footer_destinations', $footer_destinations);

        // ACTIVITIES
        $footer_activities = DB::table('activitys')->take(5)->select('title', 'slug')->get();
        View::share('footer_activities', $footer_activities);

         // COMPANY
         $footer_pages = DB::table('pages')->take(5)->select('title', 'slug', 'is_published')->where ('is_published', 1 )->get();
        View::share('footer_pages', $footer_pages);

        // SETTINGS
        $settings = DB::table('settings')->where( 'lang', 'en' )->get();
        $settings = json_decode( $settings[0]->settings, true );
        View::share('settings', $settings);

        return view('frontend.contact.form');
    }

    public function postContact(Request $request)
    {
//        $token = $request->input('g-recaptcha-response');
//        echo $token;

        $formData = [
            'sender_name' => $request->get('sender_name'),
            'sender_email'        => $request->get('sender_email'),
            'sender_phone_number' =>$request->get('sender_phone_number'),
            'subject'             => $request->get('subject'),
            'message'                => $request->get('message'),
            'created_ip'                => $request->get('created_ip'),
            'recaptcha2'                => $request->input('recaptcha2'),

        ];
//print_r($formData);
//        exit;
        $rules = [
            'sender_name' => 'required',
            'sender_email'        => 'required|email',
            'subject'             => 'required',
            'message'                => 'required',
        ];
        // $validation = Validator::make($formData, $rules);

        $formPost = new FormPost();
        $formPost->sender_name_surname = $formData['sender_name'];
        $formPost->sender_email = $formData['sender_email'];
        $formPost->sender_phone_number = $formData['sender_phone_number'];
        $formPost->subject = $formData['subject'];
        $formPost->message = $formData['message'];
        $formPost->created_ip = $formData['created_ip'];
        $formPost->lang = getLang();
        
        if($formData['recaptcha2'] == null){
            return "grecaptcha field is required.";
        }else{

            if ($formPost->save()) {
                return "Message was successfully sent.";
            }
            else {
               
                return "Message couldn't be sent.";
            }
        }

        exit;
    }
}
