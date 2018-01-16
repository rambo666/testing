<?php

namespace Fully\Http\Controllers;

use Fully\Models\Activity;
use Fully\Models\Destination;
use Fully\Models\Package;
use Fully\Models\PackageMeta;
use Fully\Models\Region;
use Fully\Repositories\Region\RegionInterface;
use Illuminate\Http\Request;

use Fully\Http\Requests;
use Fully\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use View;

class RegionController extends Controller
{
    protected $region;
    public function __construct(RegionInterface $region)
    {
        $this->region = $region;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        $footer_destinations = DB::table('destinations')->select('title', 'slug')->get();
        View::share('footer_destinations', $footer_destinations);

        // ACTIVITIES
        $footer_activities = DB::table('activitys')->select('title', 'slug')->get();
        View::share('footer_activities', $footer_activities);

        // COMPANY
        $footer_pages = DB::table('pages')->select('title', 'slug')->get();
        View::share('footer_pages', $footer_pages);

        // SETTINGS
        $settings = DB::table('settings')->where( 'lang', 'en' )->get();
        $settings = json_decode( $settings[0]->settings, true );
        View::share('settings', $settings);

        $regions = $this->region->getBySlug($slug);
        if ( $regions !== null )
        {
            $region_id = $regions->id;

            $packages = Package::where('region_id', $region_id)->get();

            $i = 0;
            foreach ($packages as $package) {
                $packagemetas = $package->packagemetas;

                foreach ($packagemetas as $packagemeta) {
                    if ($packagemeta['key'] == 'days' ){
                        $metadata[$i]['days'] = $packagemeta['value'];
                    }
                    if ($packagemeta['key'] == 'price' ){
                        $metadata[$i]['price'] = $packagemeta['value'];
                    }
                    if ($packagemeta['key'] == 'images' ){
                        $metadata[$i]['images'] = unserialize($packagemeta['value']);
                    }
                }
                $i++;

            }
            return view('frontend.region.show', compact('packages', 'metadata', 'regions'));
        }
        else
        {
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
