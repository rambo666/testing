<?php

namespace Fully\Http\Controllers\Admin;

use Fully\Http\Requests\PackageRequest;
use Illuminate\Http\Request;
//use Fully\Http\Requests\Request;
use Fully\Models\Category;
use Fully\Models\PackageMeta;
use Fully\Repositories\Activity\ActivityInterface;
use Fully\Repositories\PackageCategory\PackageCategoryInterface;
use Fully\Repositories\Destination\DestinationInterface;
use Fully\Repositories\Region\RegionInterface;
use Illuminate\Support\Facades\Redirect;
use View;
use Flash;
use Input;
use Response;
use Fully\Services\Pagination;
use Fully\Http\Controllers\Controller;
use Fully\Repositories\Package\PackageInterface;
use Fully\Exceptions\Validation\ValidationException;
use Fully\Repositories\Package\PackageRepository as Package;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class PackageController extends Controller
{
    protected $package;
    protected $packageCategory;
    protected $activity;
    protected $destination;
    protected $region;
    protected $perPage;

    public function __construct(PackageInterface $package, PackageCategoryInterface $packageCategory, ActivityInterface $activity, DestinationInterface $destination,RegionInterface $region)
    {
        $this->package = $package;
        $this->activity = $activity;
        $this->destination = $destination;
        $this->region = $region;

        $this->package_cat = $packageCategory;
        $this->perPage = config('fully.modules.package.per_page'); // config/fully.php
    }

    public function index()
    {
        // $sno = 1;
        $sno = (($this->perPage)*((Input::get('page', 1)-1)))+1;
        $pagiData = $this->package->paginate(Input::get('page', 1), $this->perPage, true);
        $packages = Pagination::makeLengthAware($pagiData->items, $pagiData->totalItems, $this->perPage);
        $destinations=$this->destination->lists();
        $activities=$this->activity->lists();
        $regions=$this->region->lists();
        //dd($packages);
        return view('backend.package.index', compact('packages', 'sno','destinations','activities','regions'));
    }

    // public function suggested()
    // {
      
    //     return view('backend.package.index', compact('packages', 'sno'));
    // }


    public function create() // Add Package Dashboard menu
    {
        $activities = $this->activity->lists(); // ActivityRepo
        $destinations = $this->destination->lists(); // DestinationRepo
        $regions = $this->region->lists(); // RegionRepo
        

        return view('backend.package.create', compact('activities', 'destinations','regions'));
    }

    public function store( PackageRequest $request )
    {

        try
        {   
            $this->package->create( Input::all() ); // PackageRepository @create , send all input to create method Input::except('title')
            Flash::message('Package was successfully added');

            return langRedirectRoute('admin.package.index');
        } catch (ValidationException $e) {

            return Redirect::route(langURL().'.admin.package.create')->withInput()->withErrors($e->getErrors());
        }
    }

    public function show($id)
    {
        $package = $this->package->find($id);

        return view('backend.package.show', compact('package'));
    }

    public function update($id)
    {
//        dd(Input::all());
        try {
            $this->package->update($id, Input::all()); // to PackageRepository
             $packageTitleForFlash = Input::get('title');
             Flash::message('Package "'.$packageTitleForFlash.'" was successfully updated');
            return langRedirectRoute('admin.package.index');
        } catch (ValidationException $e) {

            return langRedirectRoute('backend.package.edit')->withInput()->withErrors($e->getErrors());
        }
    }

    

    public function edit($id)
    {
        $destinations = $this->destination->lists(); // DestinationRepo
        $activities = $this->activity->lists(); // ActivityRepo
        $regions = $this->region->lists(); // RegionR
        //$region = $this->region->lists(); // RegionR
        $package = $this->package->find($id);
        
        //dd($package);
        $thisPackageDestination = $package->destination_id;
        $thisPackageActivity = $package->activity_id;
        

        $filteredActivity=$this->activity->listsFilterByDestinationID($thisPackageDestination);
        $filteredRegion=$this->region->listsFilterByActivityID($thisPackageActivity,$thisPackageDestination);
        //dd($filteredActivity,$filteredRegion );

        // get packagemeta of current package
        $packagemeta = $package->packagemetas->toArray();
        
        foreach ($packagemeta as $datanum => $metas):
//            dd($metas);
            $jsonData = ['itinerary', 'incexc', 'images'];
            if ( in_array($metas['key'], $jsonData) ) {
                $unValue = unserialize($metas['value']);
                $metaValue[$metas['key']] = $unValue;
            } else
            {
                $metaValue[$metas['key']] = $metas['value'];
            }
        endforeach; 
         // dd($metaValue);
        return view('backend.package.edit', compact('package', 'metaValue', 'activities', 'destinations','regions','filteredActivity','filteredRegion'));
    }
//    
  
    public function destroy($id)
    {
        $this->package->delete($id);
        Flash::message('Package was successfully deleted');

        return langRedirectRoute('admin.package.index');
    }

    public function confirmDestroy($id)
    {
        $package = $this->package->find($id);

        return view('backend.package.confirm-destroy', compact('package'));
    }

    public function changeActivity(Request $request)
    {      $attributes = $request->all();
        if ($request->ajax()){
           
            //dd($attributes['get_option']);
            $output="";
            $outputs="";
            $output1[]="";
            $activities = $this->activity->listsFilterByDestinationID($attributes['get_option']); // ActivityRepo
           
            //dd($activities);

                foreach ($activities as $key=>$activitie){
                    $outputs.="
                                
                            <option value='".$key."'>".$activitie."</option>";
                }
                $output.="<select name='activity' id='activityVal'  class = 'form-control' onchange='fetch_selectRegion(this.value)'>
                            <option disabled selected value> -- select an Activity -- </option>
                               ".$outputs." 
                            </select>";
               
                return response($output);
            }

            else{
    
                  $output.='<div class="col-sm-3"><div class="popular-package">No Result Found!</div>';
                  return $output;
              }
 

        }

        public function changeRegion(Request $request)
    {      $attributes = $request->all();
        //dd($attributes);
        if ($request->ajax()){
           
            //dd($attributes['get_option']);
            $output="";
            $output1[]="";
            $outputs="";
            $regions = $this->region->listsFilterByActivityID($attributes['get_option'],$attributes['get_optionDestination']); // ActivityRepo
        
            //dd($regions);

                foreach ($regions as $key=> $region){
                    $outputs.="<option value='".$key."'>".$region."</option>";
                }
               $output.="<select name='region' id='regionVal'  class = 'form-control' 'id'=>'textRegion' >
               <option disabled selected value> -- select a Region -- </option>
                               ".$outputs." 
                            </select>";
                return response($output);
            }

            else{
    
                  $output.='<div class="col-sm-3"><div class="popular-package">No Result Found!</div>';
                  return $output;
              }
 

        }


    //       public function changeDestination(Request $request)
    // {      $attributes = $request->all();
    //     //dd($attributes);
    //     if ($request->ajax()){
           
    //         //dd($attributes['get_option']);
    //         $output="";
    //         $output1[]="";
    //         $outputs="";
    //         $regions = $this->destination->lists(); // ActivityRepo
        
    //         //dd($regions);

    //             foreach ($regions as $key=> $region){
    //                 $outputs.="<option value='".$key."'>".$region."</option>";
    //             }
    //            $output.="<select name='region' id='regionVal'  class = 'form-control' 'id'=>'textRegion' >
    //            <option disabled selected value> -- select a Region -- </option>
    //                            ".$outputs." 
    //                         </select>";
    //             return response($output);
    //         }

    //         else{
    
    //               $output.='<div class="col-sm-3"><div class="popular-package">No Result Found!</div>';
    //               return $output;
    //           }
 

    //     }



    }
