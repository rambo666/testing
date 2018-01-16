<?php

namespace Fully\Repositories\Region;

//use Cartalyst\Support\Validator;
use Fully\Models\Destination;
use Fully\Models\Activity;
use Fully\Models\Region;
use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use Validator;
use Response;
use Str;
use Event;
use Image;
use File;
use Fully\Repositories\RepositoryAbstract;
use Fully\Repositories\CrudableInterface;
use Fully\Exceptions\Validation\ValidationException;

/**
 * Class PackageRepository.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class RegionRepository
    extends RepositoryAbstract
        implements RegionInterface, CrudableInterface
{
    protected $region;

    /**
     * Rules for validation
     * @var array
     */
    protected static $rules = [
        'title' => 'required',
        'overview' => 'required',
        'image'         =>  'required|image|mimes:jpg,jpeg,png|max:4096',
        'activity' => 'required',
        'destination' => 'required',

    ];

    public function __construct(Region $region)
    {
        $this->region = $region;
    }

    // RegionInterface.php
    public function find($id)  // CrudableInterface
    {
        return $this->region->findOrFail($id);
    }

    public function all()
    {
        return $this->region->get();
    }

     public function lists()
    {
        return $this->region->lists('title', 'id','slug');
    }

     public function listsFilterByActivityID($activityID,$destinationID)
     {
      return $this->region->where('destination_id', $destinationID)->where('activity_id',$activityID)->lists('title', 'id');
     }
    // CrudableInterface
    /**
     * @param $attributes
     * @return bool
     * @throws ValidationException
     */


     public function create($request)
     {
        //dd($this->region->fill($request));
         
        $region = new Region;
        $attributes = $request->all();
        //dd($attributes);
            // $destination = Destination::find($attributes['destination']); // find the destination of id in input
            // $activity = Activity::find($attributes['activity']); // find the activity of id in input
    if ($this->isValid($attributes))
        {

            $upload_success = null;
            $image = $request->file('image');
            // get ext.
            $image_ext = $image->getClientOriginalExtension();

            // get name
            $image_name = $image->getClientOriginalName();

            // set destination path
            $destination_path = public_path('uploads/region');

            // resize image
            $resize_image = Image::make($image->getRealPath());

            // move image from temp. location to destination
            $upload_success = $image->move($destination_path, $image_name);
            if ($upload_success) {
                $resize_image->resize(1575, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination_path.'/'.$image_name);

                $attributes['image_path'] = $image_name;

            }

         if ($this->region->fill($attributes)->save())
        {
            $destination = Destination::find($attributes['destination']); // find the destination of id in input
            $activity = Activity::find($attributes['activity']); // find the activity of id in input
            //dd($destination,$activity);
            $destination->regions()->save($this->region);
            $activity->regions()->save($this->region);
        
        }


            // $region->title = $request->input('title');
            // $region->overview = $request->input('overview');
            // $region->meta_keywords = $request->input('meta_keywords');
            // $region->meta_description = $request->input('meta_description');
            // $region->destination = $request->input('meta_description');
            // $region->activity = $request->input('meta_description');
            // $this->region->resluggify(); 

            // $region->save();


            return true;
       }
        else
        {
            throw new ValidationException('Region fields validation failed', $this->getErrors());
        }
     }

    /**
     * Update data.
     *
     * @param $id
     * @param $attributes
     *
     * @return mixed
     */
    

    public function update($id, $attributes)
    {

      $this->region = Region::find($id);
      //dd($region);
      //dd($attributes);
              // $activity = Activity::find($attributes['activity']); // find the activity of id in input
     if ($this->isUpdateValidRegion($id, $attributes))
        {
        $images = Input::file('image');
        if ( $images !== null )
        {
           
                $rules = array('file' => 'required');
                $validator = Validator::make(array('file' => $images), $rules);

                if ($validator -> passes())
                {
                    $destinationPath = 'uploads/region';
                    $filename = $images->getClientOriginalName();
                    $images->move($destinationPath, $filename);

                    
                }
            
                $attributes['image_path'] = $filename;
            
                   
                //dd($attributes['image_path']);
        }

          if ($this->region->fill($attributes)->save())
            {
                $destination = Destination::find($attributes['destination']); // find the destination of id in input
                $activity = Activity::find($attributes['activity']); // find the activity of id in input
                //dd($destination,$activity);
                $destination->regions()->save($this->region);
                $activity->regions()->save($this->region);
            
            }
            // $region->title =$attributes['title'];
            // $region->overview = $attributes['overview'];
            // $region->meta_keywords =$attributes['meta_keywords'];
            // $region->meta_description =$attributes['meta_description'];
            // $region->destination_id =$attributes['destination'];
            // $region->activity_id = $attributes['activity'];
            // $region->image_path= $attributes['image_path'];
            // $region->resluggify(); 

            // $region->save();

        return true;
        }
        
            throw new ValidationException('Region fields validation failed', $this->getErrors());
        
    }

    


    /**
     * Delete data by id.
     *
     * @param $id
     *
     * @return mixed
     */
     public function delete($id)
    {
        $region = $this->region->findOrFail($id);
        $region->delete();
    }

    public function deleteUsingID($idTodelete,$id)
    {
        $regions = $this->region->where($idTodelete,$id)->get();
        //dd($package);
        foreach($regions as $region){
            $region->delete();
            //dd($package);
        }
        
    }


     public function paginate($page = 1, $limit = 10, $all = false)
    {
      $result = new \StdClass();

        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $query = $this->region->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC');

      
        $regions = $query->skip($limit * ($page - 1))
                    ->take($limit)
                    ->get();

        $result->totalItems = $this->totalRegions($all);
        $result->items = $regions->all();

        return $result;
    }

     

    public function getBySlug($slug)
    {
        return $this->region->where('slug', $slug)->first();
    }

     protected function totalRegions($all = false)
    {

        return $this->region->count();
    }

    
}
