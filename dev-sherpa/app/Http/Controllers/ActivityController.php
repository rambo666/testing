<?php

namespace Fully\Http\Controllers;

use Fully\Models\Region;
use Fully\Repositories\Activity\ActivityInterface;
use Fully\Models\Activity;
use Fully\Models\Destination;
use Fully\Repositories\Destination\DestinationInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use View;

use Fully\Http\Requests;
use Fully\Http\Controllers\Controller;

class ActivityController extends Controller
{
    protected $activity;
    protected $destination;

    public function __construct(ActivityInterface $activity,DestinationInterface $destination)
    {
        $this->activity = $activity;
        $this->destination=$destination;
    }

    public function index()
    {
//        return 'activities';
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
         //dd($destination_slug);
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
        $footer_pages = DB::table('pages')->take(5)->select('title', 'slug')->get();
        View::share('footer_pages', $footer_pages);

        // SETTINGS
        $settings = DB::table('settings')->where( 'lang', 'en' )->get();
        $settings = json_decode( $settings[0]->settings, true );
        View::share('settings', $settings);

        $activity_meta = Activity::findBySlug($slug);

       if ($slug == 'all') {
            // get activities of all destination
            $activitiesall = Activity::all();
            $regions = Region::all();
        }else {
            // get activities of current region
            if ( Activity::findBySlug($slug) !== null ) {
                $regions =Activity::findBySlug($slug)->regions;

                if ( $regions->count() == null )
                {
                    $regionss = new Region;
                    $regions_data = $regionss->lists('title', 'slug', 'image_path');
                    $activities = new Activity;
                    $activities_data = $activities->lists('title', 'slug', 'image_path');
                    $message = "No regions found for this activity.";
                    return view('frontend.activity.show', compact('slug', 'regions', 'regions_data', 'package_count', 'message', 'activity_meta', 'activities_data','activitiesall'));
                }

            }
        }

        // get all destination title and slug
        $regionss = new Region;
        $regions_data = $regionss->lists('title', 'slug', 'image_path');
        $activities = new Activity;
        $activities_data = $activities->lists('title', 'slug', 'image_path');
        //dd($activities_data);

//        $packages = Activity::with('packages')->get();
        if ( isset( $regions ) )
        {
            foreach ($regions as $region) {
                 $package_count[] = $region->packages->count();
            }
            return view('frontend.activity.show', compact('slug', 'regions', 'regions_data', 'package_count', 'message', 'activity_meta','activities_data','activitiesall'));
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
