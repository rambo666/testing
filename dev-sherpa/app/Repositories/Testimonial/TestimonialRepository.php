<?php
// app/providers/repositoryserviceprovider.php
namespace Fully\Repositories\Testimonial;

use Illuminate\Http\Request;
use Fully\Models\Testimonial;
use Fully\Repositories\RepositoryAbstract;

use Fully\Repositories\CrudableInterface;
//use Fully\Exceptions\Validation\ValidationException;
//use Illuminate\Support\Facades\Redirect;
//use Intervention\Image\Facades\Image;
use Input;
use File;

/**
 * Class PackageCategoryRepository.
 *
 * @author Ashish Shrestha
 */
class TestimonialRepository extends RepositoryAbstract implements TestimonialInterface, CrudableInterface
{



    public function __construct(Testimonial $testimonial)
    {
        $this->testimonial = $testimonial;
    }

    public function create($request)
    {
//        $testimonial = new Testimonial;
//        $attributes = $request->all();
//
//        $testimonial->person_name = $request->person_name;
//        $testimonial->person_address = $request->person_address;
//        $testimonial->review = $request->review;
//        $testimonial->save();
//
//        return true;
    }

    public function update($id, $testimonial)
    {

    }


    public function delete($id)
    {

    }

    public function find($id) {

    }

    public function all()
    {
        // TODO: Implement paginate() method.
    }

    public function paginate($page = 1, $limit = 10, $all = false)
    {
        // TODO: Implement paginate() method.
    }

    public function lists()
    {

    }
}
