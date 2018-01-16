<?php

namespace Fully\Http\Controllers\Admin;

//use Cartalyst\Support\Validator;
use Fully\Exceptions\Validation\ValidationException;
use Fully\Models\Destination;
use Fully\Models\Package;
use Fully\Models\Region;
use Fully\Models\Activity;
use Fully\Repositories\Activity\ActivityInterface;
use Fully\Repositories\Destination\DestinationInterface;
use Fully\Repositories\Package\PackageInterface;
use Fully\Repositories\Region\RegionInterface;
use Illuminate\Http\Request;
use Fully\Services\Pagination;
use Fully\Http\Requests;
use Fully\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Image;
use File;
use Input;
use DB;
use Laracasts\Flash\Flash;

class DestinationController extends Controller
{
    protected $activity;
    protected $destination;
    protected $package;
    protected $region;
    protected $perPage;
    public function __construct(ActivityInterface $activity, DestinationInterface $destination, PackageInterface $package,RegionInterface $region)
    {
       $this->activity = $activity;
        $this->destination = $destination;
        $this->region = $region;
        $this->package = $package;
        $this->perPage = config('fully.modules.package.per_page'); // config/fully.php
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $sno = (($this->perPage)*((Input::get('page', 1)-1)))+1;
        $pagiData = $this->destination->paginate(Input::get('page', 1), $this->perPage, true);
        //dd($pagiData);
        $destinations = Pagination::makeLengthAware($pagiData->items, $pagiData->totalItems, $this->perPage);
        $count=$this->destination->totalDestinations();
        for ($i=0;$i<=$count;$i++){
            $counts[]=$i;
        }
        return view('backend.destination.index', compact('destinations','sno','counts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.destination.create');
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
            $this->destination->create($request);
            Flash::message('Destination was successfully added');

            return langRedirectRoute('admin.destination.index');
        } catch (ValidationException $e) {
            return langRedirectRoute('admin.destination.create')->withInput()->withErrors($e->getErrors());
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
        $destination = Destination::find($id);
        return view('backend.destination.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $destination = Destination::find($id);
        return view('backend.destination.edit', compact('destination'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id) // (Request $request, $id)
    {
        try {
            $destination = Destination::findOrFail($id); // old data
            $check = $this->destination->update($id, $destination);

            Flash::message('Destination was successfully updated');

           return langRedirectRoute('admin.destination.index');
       } catch (ValidationException $e)
       {
//           dd($e);
           return Redirect::route(langURL() . '.admin.destination.edit', array('destination' => $id))->withInput()->withErrors($e->getErrors());
       }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->package->deleteUsingID('destination_id',$id);
        $this->region->deleteUsingID('destination_id',$id);
        $this->activity->deleteUsingID('destination_id',$id);
        $this->destination->delete($id);
        Flash::message('Destination was successfully deleted');

        return langRedirectRoute('admin.destination.index');
    }

    public function confirmDestroy($id)
    {
        $destination = $this->destination->find($id);
        $regions=Region::where('destination_id', $id)->lists('title','id');
        $packages=Package::where('destination_id', $id)->lists('title','id');
        $activities=Activity::where('destination_id', $id)->lists('title','id');

        return view('backend.destination.confirm-destroy', compact('destination','regions','packages','activities'));
    }

//    public function all()
//    {
//
//    }
//
//    public function paginate($page = 1, $limit = 10, $all = false)
//    {
//        // TODO: Implement paginate() method.
//    }


    public function changeOrdering(Request $request)
    {
        //return dd($request);
        DB::table('destinations')
            ->where('id', $request->id)
            ->update(['ordering' => $request->option]);
    }

}
