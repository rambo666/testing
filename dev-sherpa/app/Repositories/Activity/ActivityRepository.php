<?php
// app/providers/repositoryserviceprovider.php
namespace Fully\Repositories\Activity;

use Fully\Models\Destination;
use Illuminate\Http\Request;
use Fully\Models\Activity;
use Fully\Repositories\RepositoryAbstract;
use Fully\Repositories\CrudableInterface;
use Fully\Exceptions\Validation\ValidationException;
use Fully\Http\Requests\UpdatePackageCategoryRequest;
use Intervention\Image\Facades\Image;
use Input;
use File;

/**
 * Class PackageCategoryRepository.
 *
 * @author Ashish Shrestha
 */
class ActivityRepository extends RepositoryAbstract implements ActivityInterface, CrudableInterface
{
    protected $activity;
    protected static $rules = [
        'title'         => 'required|unique:activitys',
        'description'   => 'required',
        'image'         =>  'required|image|mimes:jpg,jpeg,png|max:4096'
    ];
    protected static $activity_updaterules; // AbstractValidator.ph

    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }

    public function create($attributes)
    {
        if ($this->isValid($attributes))
        {
            $upload_success = null;
            $image = null;

            if (isset($attributes['image'])) {
                $image = $attributes['image'];
            }
            if ($image) {
                $activity_path = public_path('uploads/activity/');
                $image_name = $image->getClientOriginalName();

                $upload_success = $image->move($activity_path, $image_name);
                if ($upload_success) {
                    Image::make($activity_path.$image_name)->resize(315, 200)->save($activity_path.$image_name);

                    $this->activity->image = $image_name;
                }
            }

            $attributes['image'] = $this->activity->image;

            if ($this->activity->fill($attributes)->save())
            {
                $this->activity->resluggify(); // use SluggableTrait in Activity.php model
                $destination = Destination::find($attributes['destination']);

                $destination->activitys()->save($this->activity);
            }
            return true;
        }
        else
        {
            throw new ValidationException('Activity fields validation failed', $this->getErrors());
        }
    }

    public function update($id, $attributes)
    {
        $this->activity = $this->find($id);
        //dd($attributes);
        if ($this->isUpdateValidActivity($id, $attributes))
        {
            if (Input::hasFile('image'))
            {
                $file = $attributes['image'];
                $destinationPath = public_path('uploads/activity/');

                File::delete($destinationPath. $this->activity->image);

                $destinationPath = public_path('uploads/activity/');
                $fileName = $file->getClientOriginalName(); // New image
                $upload_success = $file->move($destinationPath, $fileName);

                if ($upload_success) {
                    Image::make($destinationPath.$fileName)->resize(315, 200)->save($destinationPath.$fileName);
                    $this->activity->image = $fileName;
                }
            }

            $attributes['image'] = $this->activity->image;

            if ($this->activity->fill($attributes)->save())
            {
                $this->activity->resluggify(); // use SluggableTrait in Activity.php model
                $destination = Destination::find($attributes['destination']);
                $destination->activitys()->save($this->activity);
            }

            return true;

        }
        throw new ValidationException('Activity validation failed', $this->getErrors());
    }


    public function delete($id)
    {
        $activity = $this->activity->findOrFail($id);
        $activity->delete();
    }

     public function deleteUsingID($idTodelete,$id)
    {
        $activities = $this->activity->where($idTodelete,$id)->get();
        //dd($package);
        foreach($activities as $activity){
            $activity->delete();
            //dd($package);
        }
        
    }

    public function find($id) {
        return $this->activity->findOrFail($id);
    }

    public function all()
    {

    }

    public function paginate($page = 1, $limit = 10, $all = false)
    {
        // TODO: Implement paginate() method.
        $result = new \StdClass();

        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $query = $this->activity->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC');

      
        $packages = $query->skip($limit * ($page - 1))
                    ->take($limit)
                    ->get();

        $result->totalItems = $this->totalActivities($all);
        $result->items = $packages->all();

        return $result;
    }

    public function lists()
    {
        return $this->activity->lists('title', 'id');
    }

     public function listsFilterByDestinationID($destinationId)
    {
        return $this->activity->where('destination_id', $destinationId)->lists('title', 'id');
    }

    public function getBySlug($slug)
    {
        return $this->activity->where('slug', $slug)->first();
    }

    protected function totalActivities($all = false)
    {

        return $this->activity->count();
    }
}
