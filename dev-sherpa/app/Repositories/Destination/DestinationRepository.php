<?php
// app/providers/repositoryserviceprovider.php
namespace Fully\Repositories\Destination;

use Illuminate\Http\Request;
use Fully\Models\Destination;
use Fully\Repositories\RepositoryAbstract;

use Fully\Repositories\CrudableInterface;
use Fully\Exceptions\Validation\ValidationException;
use Fully\Http\Requests\UpdatePackageCategoryRequest;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Input;
use File;

/**
 * Class PackageCategoryRepository.
 *
 * @author Ashish Shrestha
 */
class DestinationRepository extends RepositoryAbstract implements DestinationInterface, CrudableInterface
{

    protected $destination;

    protected static $rules = [
            'title'         => 'required|unique:destinations',
            'description'   => 'required',
            'image'         =>  'required|image|mimes:jpg,jpeg,png|max:4096'
    ];

    protected static $destupdaterules;

//    protected  $rules = $this->rules();

    public function __construct(Destination $destination)
    {
        $this->destination = $destination;
    }

    public function create($request)
    {
        $destination = new Destination;
        $attributes = $request->all();
        if ($this->isValid($attributes))
        {
            $upload_success = null;
            $image = $request->file('image');

            // get ext.
            $image_ext = $image->getClientOriginalExtension();

            // get name
            $image_name = $image->getClientOriginalName();

            // set destination path
            $destination_path = public_path('uploads/destination');

            // resize image
            $resize_image = Image::make($image->getRealPath());

            // move image from temp. location to destination
            $upload_success = $image->move($destination_path, $image_name);
            if ($upload_success) {
                $resize_image->resize(1575, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination_path.'/'.$image_name);

                $destination->image_path = $image_name;
            }

            $destination->title = $request->input('title');
            $destination->description = $request->input('description');
            $destination->meta_keywords = $request->input('meta_keywords');
            $destination->meta_description = $request->input('meta_description');
            $this->destination->resluggify(); // use SluggableTrait in Activity.php model

            $destination->save();


            return true;
        } // to view error dd: $this->getErrors()
        else
        {
            throw new ValidationException('Destination fields validation failed', $this->getErrors());
        }
    }

    public function update($id, $destination)
    {

        $this->destination = $this->find($id);
        $formData = Input::all(); // from form
//        dd('test');
        if ($this->isUpdateValidDestination($id, $formData)) { // AbstractValidator.php
            // if image is changed

            if (Input::hasFile('image'))
            {
                $image = $formData['image'];
                // delete old image
                $destination_path = public_path('uploads/destination/');
                File::delete($destination_path.$destination->image_path); // delete image

                // upload new image
    //          $destination_path = public_path('uploads/destination/');
                    $image_name = $image->getClientOriginalName();

                    // make ready to resize image
                    $resize_image = Image::make($image->getRealPath());

                    $upload_success = $image->move($destination_path, $image_name);

                    if ($upload_success)
                    {
                        $resize_image->resize(1575, 600, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($destination_path.'/'.$image_name);

                        $destination->image_path = $image_name;
                    }

                }
                $destination->title = $formData['title'];
                $destination->description = $formData['description'];

                $destination->meta_keywords = $formData['meta_keywords'];
                $destination->meta_description = $formData['meta_description'];

                $destination->resluggify();


                $destination->save();
                return true;
        }
//        return Redirect::route(langURL(). '.admin.destination.edit', [$id])->withErrors($this->getErrors());
//        dd($this->getErrors());
        throw new ValidationException('Destination validation failed', $this->getErrors());
    }


    public function delete($id)
    {
        $destination = $this->destination->findOrFail($id);
        $destination->delete();
    }

    public function find($id) {
        return $this->destination->findOrFail($id);
    }

    public function all()
    {
        // TODO: Implement paginate() method.
    }

    public function paginate($page = 1, $limit = 10, $all = false)
    {
        // TODO: Implement paginate() method.
         $result = new \StdClass();

        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $query = $this->destination->orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC');

      
        $destinations = $query->skip($limit * ($page - 1))
                    ->take($limit)
                    ->get();

        $result->totalItems = $this->totalDestinations($all);
        $result->items = $destinations->all();

        return $result;
    }

    public function lists()
    {
        return $this->destination->lists('title', 'id');
    }

     public function totalDestinations($all = false)
    {

        return $this->destination->count();
    }
}
