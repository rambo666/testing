<?php
namespace Fully\Repositories\Package;
//use Cartalyst\Support\Validator;
use Fully\Models\Destination;
use Fully\Models\Activity;
use Fully\Models\Package;
use Fully\Models\Region;
use Fully\Models\PackageMeta;
use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
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
class PackageRepository
    extends RepositoryAbstract
        implements PackageInterface, CrudableInterface
{
    protected $package;
    /**
     * Rules for validation
     * @var array
     */
    protected static $rules = [
        
        'title' => 'required',
       
    ];
    public function __construct(Package $package)
    {
        $this->package = $package;
    }
    // RepositoryInterface.php
    public function find($id)  // CrudableInterface
    {
        return $this->package->findOrFail($id);
    }
    public function all()
    {
        return $this->package->get();
    }
     public function lists()
    {
        return $this->package->lists('title', 'id','slug');
    }
    // CrudableInterface
    /**
     * @param $attributes
     * @return bool
     * @throws ValidationException
     */
    public function create($attributes) // $attribute stores values from add package form
    {
        $attributes['is_published'] = isset($attributes['is_published']) ? true : false;
        $attributes['is_popular'] = isset($attributes['is_popular']) ? true : false;
        $attributes['is_suggested'] = isset($attributes['is_suggested']) ? true : false;
        $packageKey = array( '_token', 'title', 'overview', 'meta_keywords', 'meta_description', 'is_published', 'activity', 'destination','region','is_suggested' );// packages columnnames
        $packageMeta = array_diff_key($attributes, array_flip($packageKey)); // packagemeta
//        $packageData = array_diff_key($attributes, $packageMeta); // data for packages
        // insert into packages table
       //dd($this->package->fill($attributes));
        
        if ($this->package->fill($attributes)->save())
        {
            $destination = Destination::find($attributes['destination']); // find the destination of id in input
            $activity = Activity::find($attributes['activity']); // find the activity of id in input
            $region = Region::find($attributes['region']); // find the activity of id in input
            $destination->packages()->save($this->package);
            $activity->packages()->save($this->package);
            $region->packages()->save($this->package);
        }
        // UPLOAD IMAGES
        $images = Input::file('images');
        $uploadcount = 0;
        foreach ($images as $image)
        {
            $rules = array('file' => 'required');
            $validator = Validator::make(array('file' => $image), $rules);
            if ($validator -> passes())
            {
                $destinationPath = 'uploads/package';
                $filename = $image->getClientOriginalName();
                $image->move($destinationPath, $filename);
                $uploadcount++;
            }
        }
//        if ($uploadcount == $file_count){ echo 'uploaded'; }
        $image_names = array();
        foreach ($packageMeta['images'] as $key => $image)
        {
            $filename = $image->getClientOriginalName();
            $image_names[] = $filename;
        }
        $packageMeta['images'] = $image_names;
        // INSERT PACKAGE META
        foreach($packageMeta as $key=>$val){
            // serialize some field
            if ( $key == 'itinerary' || $key == 'incexc' || $key == 'images' ) {
                $dataMeta['key']=$key;
                $dataMeta['value']=serialize($val);
            } else {    // dont serialize others
                $dataMeta['key']=$key;
                $dataMeta['value']=$val;
            }
            $this->package->packagemetas()->create($dataMeta);
        }
    
        
    }
    public function update($id, $attributes) // from PackageController
    {
        $this->package = $this->find($id);
       //dd($this->package,$attributes);
        
        $itin = $attributes['itinerary'];
        $count_it = count($itin);
        foreach( $itin as $key => $itinerary) {
            if(($count_it != 1) && ($itinerary['daytitle'] === "") && ($itinerary['daydetails'] === "") && ($itinerary['accommodation'] === "")  && ($itinerary['walkhrs'] === "") && ($itinerary['maxaltitude'] === "") && ($itinerary['lat'] === "") && ($itinerary['lng'] === ""))
            {
                unset($itin[$key]);     
            }              
        }
        $itin = array_values($itin);
        $attributes['itinerary'] = $itin;
        
        // REMOVING BLANK ROWS FROM TRIP INCLUSION
        // Inclusions
        $inc = $attributes['incexc']['inc'];
        $count_inc = count($inc);
        foreach( $inc as $key => $include) {
            if(($count_inc != 1) && ($include === "")){
                unset($inc[$key]);
            }
        } 
        $inc = array_values($inc);
        $attributes['incexc']['inc'] = $inc;
        // end of Inclusions
        // Exclusions
        $exc = $attributes['incexc']['exc'];
        $count_exc = count($exc);
        foreach( $exc as $key => $exclude) {
            if(($count_exc != 1) && ($exclude === "")){
                unset($exc[$key]);
            }
        }
        $exc = array_values($exc);
        $attributes['incexc']['exc'] = $exc;
        // end of Exclusions
        // END OF TRIP INCLUSIONS
        $attributes['is_popular'] = isset($attributes['is_popular']) ? true : false;
        $attributes['is_published'] = isset($attributes['is_published']) ? true : false;
         $attributes['is_suggested'] = isset($attributes['is_suggested']) ? true : false;
        $packageKey = array( '_method', '_token', 'title', 'overview', 'meta_keywords', 'meta_description', 'is_published', 'activity', 'destination','region','is_suggested','dummyActivity','dummyRegion' );// packages columnnames
        $oldImg = array('oldImages');
        $packageMeta = array_diff_key($attributes, array_flip($packageKey), array_flip($oldImg)); // packagemeta
//        $packageData = array_diff_key($attributes, $packageMeta); // data for packages
 // $image_names = array();
 //            $it_count=0;
 //            foreach ($attributes['oldImages'] as $key => $image)
 //            {
               
               
 //               $a[$it_count] = $image;
                
 //                $it_count++;
 //            }
//         updatepackages table
        if ($this->package->fill($attributes)->save())
        {
            $this->package->resluggify();
            $destination = Destination::find($attributes['destination']); // find the destination of id in input
            $activity = Activity::find($attributes['activity']); // find the activity of id in input
            $region = Region::find($attributes['region']); // find the activity of id in input
            $destination->packages()->save($this->package);
            $activity->packages()->save($this->package);
            $region->packages()->save($this->package);
        }
//         UPLOAD IMAGES
        $images = Input::file('images');
        if ( $images[0] !== null )
        {
            // dd($images);
            $uploadcount = 0;
            foreach ($images as $image)
            {
                $rules = array('file' => 'required');
                $validator = Validator::make(array('file' => $image), $rules);
                if ($validator -> passes())
                {
                    $destinationPath = 'uploads/package';
                    $filename = $image->getClientOriginalName();
                    $image->move($destinationPath, $filename);
                    $uploadcount++;
                }
            }
            $image_names = array();
            foreach ($packageMeta['images'] as $key => $image)
            {
                $filename = $image->getClientOriginalName();
                $image_names[] = $filename;
            }
            $packageMeta['images'] = $image_names;
            
        }
        
// dd($packageMeta);
        // INSERT PACKAGE META
        foreach($packageMeta as $key=>$val){
            // serialize some field
            if ( $key == 'itinerary' || $key == 'incexc') {
                $dataMeta['key']=$key;
                $dataMeta['value']=serialize($val);
            } 
            else if  ($key == 'images' ) {
                        
                           
                            if (empty($image_names) && !empty($attributes['oldImages'] )) // adding only old image if no file has been uploaded
                            {
                                $allImages = $attributes['oldImages'];
                                $dataMeta['key']=$key;
                                $dataMeta['value']=serialize($allImages);
                            }
                            elseif (empty($attributes['oldImages']) && !empty($image_names)) 
                            {
                                $allImages = $packageMeta['images'];//adding old and new images
                                $dataMeta['key']=$key;
                                $dataMeta['value']=serialize($allImages);      
                            }
                            
                            else {
                                $allImages = array_merge($attributes['oldImages'],$packageMeta['images']);//adding old and new images
                                $dataMeta['key']=$key;
                                $dataMeta['value']=serialize($allImages);
                            }
                                
                                
            }
            else {    // dont serialize others
                $dataMeta['key']=$key;
                $dataMeta['value']=$val;
            }
            $updateDetails = PackageMeta::where(['package_id'=> $id, 'key' => $dataMeta['key']])->first();
            $updateDetails->value = $dataMeta['value'];
            $updateDetails->save();
        }
    }
    /**
     * Get paginated articles.
     *
     * @param int  $page  Number of articles per page
     * @param int  $limit Results per page
     * @param bool $all   Show published or all
     *
     * @return StdClass Object with $items and $totalItems for pagination
     */
    public function paginate($page = 1, $limit = 10, $all = false)
    {
        $result = new \StdClass();
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();
        $query = $this->package->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC');
        if (!$all) {
            $query->where('is_published', 1);
        }
        $packages = $query->skip($limit * ($page - 1))
                    ->take($limit)
                    ->get();
        $result->totalItems = $this->totalPackages($all);
        $result->items = $packages->all();
        return $result;
    }
    public function getBySlug($slug)
    {
        return $this->package->where('slug', $slug)->first();
    }
    public function delete($id)
    {
        $package = $this->package->findOrFail($id);
        $package->delete();
    }
     public function deleteUsingID($idTodelete,$id)
    {
        $packages = $this->package->where($idTodelete,$id)->get();
        //dd($package);
        foreach($packages as $package){
            $package->delete();
            //dd($package);
        }
        
    }
    protected function totalPackages($all = false)
    {
        if (!$all)
        {
            return $this->package->where('is_published', 1)->count();
        }
        return $this->package->count();
    }
    public function togglePublish($id)
    {
        $package = $this->package->find($id);
        $package->is_published = ($package->is_published) ? false : true;
        $package->save();
        return Response::json(array('result' => 'success', 'changed' => ($package->is_published) ? 1 : 0));
    }
}