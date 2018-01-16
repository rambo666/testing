<?php

namespace Fully\Http\Controllers;

use Fully\Models\Activity;
use Fully\Models\Destination;
use Fully\Models\Region;
use Illuminate\Http\Request;

use Fully\Http\Requests;
use Fully\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use View;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TESTIMONIAL
        $testimonials = DB::table('testimonials')->get();
        View::share('testimonials', $testimonials);

        /**
         * FOOTER
         */
        

        // SETTINGS
        $settings = DB::table('settings')->where( 'lang', 'en' )->get();
        $settings = json_decode( $settings[0]->settings, true );
        View::share('settings', $settings);

        /**
         * FOOTER
         */

        // DESTINATIONS
        $footer_destinations = DB::table('destinations')->take(5)->select('title', 'slug')->get();
        View::share('footer_destinations', $footer_destinations);

        // ACTIVITIES
        $footer_activities = DB::table('activitys')->take(5)->select('title', 'slug')->get();
        View::share('footer_activities', $footer_activities);

        $destinations = Destination::orderBy('ordering')->get();
        return view('frontend.destination.index', compact('destinations'));
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
    public function show($slug)
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

        $destinations_meta = Destination::findBySlug($slug);

        if ($slug == 'all') {
            // get activities of all destination
            $activities = Activity::all();
            $regions = Region::all();
        }else {
            // get activities of current destination
            if ( Destination::findBySlug($slug) !== null ) {
                $activities = Destination::findBySlug($slug)->activitys;

                if ( $activities->count() == null )
                {

                    // get all destination title and slug
                    $destinations = new Destination;
                    $destinations_data = $destinations->lists('title', 'slug', 'image_path');
                    $message = "No activities found";
                    return view('frontend.destination.show', compact('slug', 'activities', 'destinations_data', 'package_count', 'message', 'destinations_meta'));
                }

            }
        }

        // get all destination title and slug
        $destinations = new Destination;
        $destinations_data = $destinations->lists('title', 'slug', 'image_path');


//        $packages = Activity::with('packages')->get();
        if ( isset( $activities ) )
        {
            foreach ($activities as $activity) {
                $region_count[] = $activity->regions->count();
            }
            return view('frontend.destination.show', compact('slug', 'activities', 'destinations_data', 'region_count', 'message', 'destinations_meta'));
        } else {
            return view( 'errors.missing' );
        }

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
