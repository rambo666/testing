<?php

namespace Fully\Http\Controllers\Admin;

use Fully\Exceptions\Validation\ValidationException;
use Fully\Models\Activity;
use Fully\Models\Destination;
use Fully\Models\Package;
use Fully\Models\Region;
use Fully\Repositories\Activity\ActivityInterface;
use Fully\Repositories\Destination\DestinationInterface;
use Fully\Repositories\Package\PackageInterface;
use Fully\Repositories\Region\RegionInterface;
use Illuminate\Http\Request;
use Fully\Services\Pagination;
use Fully\Http\Requests;
use Fully\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use Input;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $activity;
    protected $destination;
    protected $package;
    protected $region;
    protected $perPage;

    public function __construct( ActivityInterface $activity, DestinationInterface $destination, PackageInterface $package,RegionInterface $region)
    {
        $this->activity = $activity;
        $this->destination = $destination;
        $this->region = $region;
        $this->package = $package;
        $this->perPage = config('fully.modules.package.per_page'); // config/fully.php
    }

    public function index()
    {
         $sno = (($this->perPage)*((Input::get('page', 1)-1)))+1;
        //$activities = Activity::paginate(10)->orderby;
        $pagiData = $this->activity->paginate(Input::get('page', 1), $this->perPage, true);
        $destinations=$this->destination->lists();

        //dd($destinations);
        $activities = Pagination::makeLengthAware($pagiData->items, $pagiData->totalItems, $this->perPage);
        return view('backend.activity.index', compact('activities','sno','destinations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $destinations = $this->destination->lists();
        return view('backend.activity.create', compact('destinations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $this->activity->create(Input::all());
            Flash::message('Activity was successfully added');

            return langRedirectRoute('admin.activity.index');
        } catch (ValidationException $e)
        {
            return langRedirectRoute('admin.activity.create')->withInput()->withErrors($e->getErrors());
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
        $activity = Activity::find($id);
        return view('backend.activity.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = Activity::find($id);
        $destinations = $this->destination->lists();
        return view('backend.activity.edit', compact('activity', 'destinations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        try {
//            $activity = Activity::findOrFail($id); // old data
            $this->activity->update($id, Input::all());

            Flash::message('Activity was successfully updated');

            return langRedirectRoute('admin.activity.index');
        } catch (ValidationException $e)
        {
            return Redirect::route(langURL() . '.admin.activity.edit', array('activity' => $id))->withInput()->withErrors($e->getErrors());
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
        $this->package->deleteUsingID('activity_id',$id);
        $this->region->deleteUsingID('activity_id',$id);
        $this->activity->delete($id);
        Flash::message('Activity was successfully deleted');

        return langRedirectRoute('admin.activity.index');
    }

    public function confirmDestroy($id)
    {
        $activity = $this->activity->find($id); // @see Repo
        $regions=Region::where('activity_id', $id)->lists('title','id');
        $packages=Package::where('activity_id', $id)->lists('title','id');
        return view('backend.activity.confirm-destroy', compact('activity','regions','packages'));
    }
}
