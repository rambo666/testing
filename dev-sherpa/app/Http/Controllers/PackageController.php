<?php

namespace Fully\Http\Controllers;

use Fully\Models\Activity;
use Fully\Models\Destination;
use Fully\Models\Package;
use Fully\Models\PackageMeta;
use Fully\Repositories\Package\PackageInterface;
use Illuminate\Http\Request;

use Fully\Http\Requests;
use Fully\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use View;

class PackageController extends Controller
{
    protected $package;
    public function __construct(PackageInterface $package)
    {
        $this->package = $package;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.package.index');
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

        

        // SETTINGS
        $settings = DB::table('settings')->where( 'lang', 'en' )->get();
        $settings = json_decode( $settings[0]->settings, true );
        View::share('settings', $settings);

        $package = Package::where('slug', $slug)->first();
        if ( isset( $package ) )
        {
            $package_id = $package->id;

            $packageMeta = PackageMeta::where('package_id', $package_id)->get();

            foreach ($packageMeta as $datanum => $metas):

                $jsonData = ['itinerary', 'incexc', 'images'];
                if ( in_array($metas->key, $jsonData) ) {
                    $unValue = unserialize($metas->value);
                    $metaValue[$metas->key] = $unValue;
                } else
                {
                    $metaValue[$metas->key] = $metas->value;
                }
            endforeach;

            $destination_id = $package->destination_id;
            $destination = Destination::find($destination_id);

            return view('frontend.package.show', compact('package', 'metaValue', 'destination', 'testimonials', 'settings'));
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

    public function getLatLng($slug)
    {
        $packagedata = $this->package->getBySlug($slug);
//        dd($packagedata->id);
//        $metadata = $packagedata->packagemetas();
        $packagemeta = new PackageMeta;
        $metadata = $packagemeta->where('package_id', $packagedata->id)->where('key', 'itinerary')->get();
        $itinerary = $metadata[0];
        $arr_itinerary = $itinerary->value;
        $data = unserialize($arr_itinerary);

//        fore
//        $except = ['lat'];
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        foreach ($data as $item) {
            $lat = $item['lat'];
            $lng = $item['lng'];
            $latlng['lat'][] = $lat;
            $latlng['lng'][] = $lng;

        }
        echo '<pre>';
        print_r($latlng);
        echo '</pre>';
        die;
    }
}
