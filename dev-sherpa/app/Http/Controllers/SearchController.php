<?php

namespace Fully\Http\Controllers;

use Fully\Models\Package;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use View;
use Search;
use Fully\Services\Pagination;
use Fully\Repositories\Package\PackageInterface;
use Illuminate\Support\Facades\Redirect;
use Fully\Models\FormPost;
/**
 * Class SearchController.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class SearchController extends Controller
{
    protected $package;

    public function __construct(PackageInterface $package)
    {
        $this->package = $package;
    }
    
    public function index(Request $request)
    {
       
    }


    public function searches(Request $request)
    {
        if ($request->ajax()){
            $output="";
            $titles=DB::table('packages')->where ('title', 'LIKE', '%'.$request->search.'%' )->get();

            if ($titles)
            {
               
                
                
                foreach ($titles as $key => $title) 
                {

                    $images=DB::table('packagemeta')->select('value')->where ('package_id',$title->id)
                                                                    ->where('key','images')->get();
                     

                    $package = $this->package->find($title->id);
                    $packagemeta = $package->packagemetas->toArray();

                    foreach ($packagemeta as $datanum => $metas){
            //            dd($metas);
                        $jsonData = ['itinerary', 'incexc', 'images'];
                        if ( in_array($metas['key'], $jsonData) ) {
                            $unValue = unserialize($metas['value']);
                            $metaValue[$metas['key']] = $unValue;
                        } else
                        {
                            $metaValue[$metas['key']] = $metas['value'];
                        }
                    } 

                    //dd(public_path());
                    $overview= str_limit($title->overview, 120);
                    $output.='<div class="col-sm-3"><div class="popular-package">'.

                                
                                '<a href="/dev-sherpa/public/'.langURL().'/packages/'.$title->slug.'">
                                <figure><img src ="/dev-sherpa/public/uploads/package/'.$metaValue['images'][0].'" height="200" width="200"></figure>
                                <div class="popular-details"><h2>'.$title->title.'</h2>'.
                                '<p>'.$overview.'</p></div>
                                </a></div></div>';
                        
                }    

                return Response($output);
            }

                     else{
    
                  $output.='<div class="col-sm-3"><div class="popular-package">No Result Found!</div>';
                  return Response($output);
             }
 

        }
    }




public function displaySuggested(Request $request){
 if ($request->ajax()){
            $output="";
            $titles=DB::table('packages')->where ('is_suggested', 1 )->take(8)->get();

            if ($titles)
            {
               
                
                
                foreach ($titles as $key => $title) 
                {

                    $images=DB::table('packagemeta')->select('value')->where ('package_id',$title->id)
                                                                    ->where('key','images')->get();
                     

                    $package = $this->package->find($title->id);
                    $packagemeta = $package->packagemetas->toArray();

                    foreach ($packagemeta as $datanum => $metas){
            //            dd($metas);
                        $jsonData = ['itinerary', 'incexc', 'images'];
                        if ( in_array($metas['key'], $jsonData) ) {
                            $unValue = unserialize($metas['value']);
                            $metaValue[$metas['key']] = $unValue;
                        } else
                        {
                            $metaValue[$metas['key']] = $metas['value'];
                        }
                    } 




                    //dd(public_path());
                    $overview= str_limit($title->overview, 120);
                    $output.='<div class="col-sm-3"><div class="popular-package">'.
                                '<a href="/dev-sherpa/public/'.langURL().'/packages/'.$title->slug.'">
                                <figure><img src ="/dev-sherpa/public/uploads/package/'.$metaValue['images'][0].'" class="img-thumbnail" height="200" width="200"></figure>
                                <div class="popular-details"><h2>'.$title->title.'</h2>'.
                                '<p>'.$overview.'</p></div>
                                </a></div></div>';
                        
                }    

                return Response($output);
            }



        }

    
}

    
}
