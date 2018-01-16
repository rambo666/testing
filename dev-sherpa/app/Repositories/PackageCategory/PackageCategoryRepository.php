<?php

namespace Fully\Repositories\PackageCategory;

//use Fully\Http\Requests\Request;
use Illuminate\Http\Request;
use Fully\Models\PackageCategory;
use Fully\Repositories\RepositoryAbstract;
//use Fully\Repositories\PackageCategory\PackageCategoryInterface;
use Fully\Repositories\CrudableInterface;
use Fully\Exceptions\Validation\ValidationException;
use Fully\Http\Requests\UpdatePackageCategoryRequest;

/**
 * Class PackageCategoryRepository.
 *
 * @author Ashish Shrestha
 */
class PackageCategoryRepository extends RepositoryAbstract implements PackageCategoryInterface, CrudableInterface
{

    protected $packageCategory;

    protected static $rules = [
        'name' => 'required|min:3|unique:package_categories',
        'description' => 'required'
    ];

    protected static $updaterules;

//    protected  $rules = $this->rules();

    public function __construct(PackageCategory $packageCategory)
    {
        $this->packageCategory = $packageCategory;
    }


    /**
     * Create new data.
     *
     * @param $attributes
     *
     * @return mixed
     */
    public function create($attributes)
    {
        if ($this->isValid($attributes)) { // checks validation $rules above
            $this->packageCategory->fill($attributes)->save();

            return true;
        }
        throw new ValidationException('Package category validation failed', $this->getErrors());
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
        $this->packageCategory = $this->find($id);

        if ($this->isUpdateValid($id,$attributes)) { // isUpdateValid : AbstractValidator.php
            $this->packageCategory->resluggify();
            $this->packageCategory->fill($attributes)->save();

            return true;
        }

        throw new ValidationException('Package category validation failed', $this->getErrors());

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
        $this->packageCategory = $this->packageCategory->find($id);
        $this->packageCategory->delete();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return $this->packageCategory->findOrFail($id);
    }

    /**
     * Get al data.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->packageCategory->get();
    }

    /**
     * Get data with paginate.
     *
     * @param int $page
     * @param int $limit
     * @param bool $all
     *
     * @return mixed
     */
    public function paginate($page = 1, $limit = 10, $all = false)
    {
        // TODO: Implement paginate() method.
    }

    public function lists()
    {
        return $this->packageCategory->lists('name', 'id'); // lists(value, key)
    }
}
