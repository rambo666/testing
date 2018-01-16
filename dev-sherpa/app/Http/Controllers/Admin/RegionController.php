<?php

namespace Fully\Http\Controllers\Admin;


use Illuminate\Http\Request;
//use Fully\Http\Requests\Request;
// use Fully\Models\Category;
use Fully\Repositories\Activity\ActivityInterface;
use Fully\Repositories\Destination\DestinationInterface;
use Illuminate\Support\Facades\Redirect;
use View;
use Flash;
use Input;
use Response;
use Fully\Services\Pagination;
use Fully\Http\Controllers\Controller;
use Fully\Repositories\Region\RegionInterface;
use Fully\Exceptions\Validation\ValidationException;
use Fully\Repositories\Package\PackageInterface;
use Fully\Models\Package;
use Fully\Repositories\Region\RegionRepository as Region;
use Fully\Repositories\CrudableInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class RegionController extends Controller
{
    protected $package;
    protected $region;
    protected $activity;
    protected $destination;
    protected $perPage;

    public function __construct(RegionInterface $region, ActivityInterface $activity, DestinationInterface $destination,PackageInterface $package)
    {
        $this->region = $region;
        $this->activity = $activity;
        $this->destination = $destination;
        $this->package = $package;

        $this->perPage = config('fully.modules.package.per_page'); // config/fully.php
    }

    public function index()
    {
        $sno = (($this->perPage)*((Input::get('page', 1)-1)))+1;
        $pagiData = $this->region->paginate(Input::get('page', 1), $this->perPage, true);
        //dd($pagiData);

        $destinations=$this->destination->lists();
        $activities=$this->activity->lists();
        //dd($activities,$destinations);
        $regions = Pagination::makeLengthAware($pagiData->items, $pagiData->totalItems, $this->perPage);
        //dd($regions[0]['title']);
        return view('backend.region.index', compact('regions','sno','destinations','activities'));
       
    }

    public function create()
    {
        $activities = $this->activity->lists(); // ActivityRepo
        $destinations = $this->destination->lists(); // DestinationRepo
        //dd($activities[55],$destinations);
        return view('backend.region.create', compact('activities', 'destinations'));
       
    }

 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->region->create($request);
            Flash::message('Region was successfully added');

            return langRedirectRoute('admin.region.index');
        } catch (ValidationException $e) {
            return langRedirectRoute('admin.region.create')->withInput()->withErrors($e->getErrors());
        }

    }


    public function edit($id)
    {
        $activities = $this->activity->lists(); // ActivityRepo
        $destinations = $this->destination->lists(); // DestinationRepo
        $region = $this->region->find($id);

        //dd($activities);
         // dd($metaValue);
        return view('backend.region.edit', compact('region','activities', 'destinations'));
    }

     public function update($id)
    {
        //dd($id);
        try {

            $this->region->update($id, Input::all()); // to RegionRepository
             $regionTitleForFlash = Input::get('title');
             Flash::message('Region "'.$regionTitleForFlash.'" was successfully updated');
            return langRedirectRoute('admin.region.index');
        } catch (ValidationException $e) {

            return Redirect::route(langURL() . '.admin.region.edit', array('region' => $id))->withInput()->withErrors($e->getErrors());
        }
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $region = $this->region->find($id);
        return view('backend.region.show', compact('region'));
    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $this->package->deleteUsingID('region_id',$id);
        $this->region->delete($id);
        Flash::message('Region was successfully deleted');

        return langRedirectRoute('admin.region.index');
    }

    public function confirmDestroy($id)
    {
        $region = $this->region->find($id);
        $packages=Package::where('region_id', $id)->lists('title','id');
        //dd($packages);
        return view('backend.region.confirm-destroy', compact('region','packages'));
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
                $output.="<select name='activity' class = 'form-control'>
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

        public function changeActivitySecond(Request $request)
    {      $attributes = $request->all();
        if ($request->ajax()){
           
            //dd($attributes['get_option']);
            $output="";
            $outputs="";
            $output1[]="";
            $selectedOpt="";
            $activities = $this->activity->listsFilterByDestinationID($attributes['get_option']); // ActivityRepo
           
            //dd($activities);

                
                foreach ($activities as $key=>$activitie){
                    if ($key == $attributes['getAct'])
                    {
                        $selectedOpt="selected";
                    }
                    else{ $selectedOpt="";}

                    $outputs.="
                                
                            <option value='".$key."' ".$selectedOpt.">".$activitie."</option>";
                }
                $output.="<select name='activity' class = 'form-control'>
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
    

    }
