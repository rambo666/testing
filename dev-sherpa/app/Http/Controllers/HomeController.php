<?php

namespace Fully\Http\Controllers;

//use Fully\Repositories\Project\ProjectInterface;
use Fully\Models\Activity;
use Fully\Models\Content;
use Fully\Models\Destination;
use Fully\Models\Package;
use Fully\Models\PackageMeta;
use Fully\Repositories\Slider\SliderInterface;

//use Fully\Repositories\Tag\TagInterface;
use Illuminate\Support\Facades\DB;
use View;
use LaravelLocalization;
use Fully\Models\Slider;

/**
 * Class HomeController.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class HomeController extends Controller
{
    protected $slider;
    protected $package;
    protected $packagemeta;

//    public function __construct(SliderInterface $slider, ProjectInterface $project, TagInterface $tag)
    public function __construct(SliderInterface $slider, PackageMeta $packagemeta, Package $package)
    {
        $this->slider = $slider;
        $this->packagemeta = $packagemeta;
        $this->package = $package;
    }

    public function index()
    {
//dd("work on progress");

      

        // SLIDER
        $sliders = Slider::all();

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

        // POPULAR PACKAGES
        $popular_packages = PackageMeta::all()
            ->where('key', 'is_popular')
            ->where('value', '1');

        //code here


        //foreach ($popular_packages as $popular_package )
        //{
            //$package_id = $popular_package->package_id;

            //$packagedata = Package::find($package_id)->toArray();

            //$packagemetadata = Package::find($package_id)->packagemetas()->get()->toArray();
            //foreach ($packagemetadata as $data )
            //{
           //     if ($data['key'] == 'images' && !empty($data['value'])) {
                   // $images = $data['value'];
                    //$images = unserialize($images);

                    //foreach ($images as $image ){
                      //  $key = 'images';
                    //    $value = $images;
                  //  }
                //}
                //else {
                    //$key = $data['key'];
                  //  $value = $data['value'];
                //}

              //  $metadata[$key] = $value;
            //}

            //$metadata['images'] = $metadata['images'][0];
          //  $alldata[] = $packagedata+ $metadata;
         //}

         //end



        if(Destination::findBySlug('nepal')){
            $all_activities = Destination::findBySlug('nepal')->activitys;

            $data=array();
            foreach ($all_activities as $all_activity) {
                $packages = $all_activity->packages;
                $i=0;
                $data_temp=array();
                foreach ($packages as $package)
                {
                    $packagemeta = $package->packagemetas;
                    $is_popular=false;
                    foreach ($packagemeta as $item)
                    {
                        if($item->key=="days"){
                            $days=$item->value;
                        }
                        if($item->key=="price"){
                            $price=$item->value;
                        }
                        if($item->key=="images"){
                            $images=$item->value;
                            $images=unserialize($images);
                            $image=$images[0];
                        }
                        if($item->key=="is_popular"){
                            if($item->value==1){
                                $is_popular=true;
                            }
                        }

                    }
                    if($is_popular) {
                        $data_temp['package'][$i]['title'] = $package->title;
                        $data_temp['package'][$i]['slug'] = $package->slug;
                        $data_temp['package'][$i]['overview'] = $package->overview;
                        $data_temp['package'][$i]['days']=$days;
                        $data_temp['package'][$i]['price']=$price;
                        $data_temp['package'][$i]['image']=$image;
                    }
                    $i++;
                }
                if(!empty($data_temp)) {
                    $data_temp['activity_name']=$all_activity->title;
                    $data_temp['activity_slug']=$all_activity->slug;
                    $data_temp['overview']=$all_activity->overview;
                    array_push($data,$data_temp);
                }
            }
        }
        else{
            $data = array();
        }

        return view('frontend.layout.dashboard', compact('sliders', 'languages', 'alldata', 'data'));
    }
}
