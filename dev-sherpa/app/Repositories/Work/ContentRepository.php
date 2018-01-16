<?php

namespace Fully\Repositories\Work;

use Fully\Models\Work;
use Config;
use Response;
use Fully\Models\Tag;
use Fully\Models\Category;
use Str;
use Event;
use Image;
use File;
use Fully\Repositories\RepositoryAbstract;
use Fully\Repositories\CrudableInterface as CrudableInterface;
use Fully\Exceptions\Validation\ValidationException;

/**
 * Class WorkRepository.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class WorkRepository extends RepositoryAbstract implements WorkInterface, CrudableInterface
{
    protected $width;
    protected $height;
    protected $thumbWidth;
    protected $thumbHeight;
    protected $imgDir;
    protected $perPage;
    protected $content;
    /**
     * Rules.
     *
     * @var array
     */
    protected static $rules = [
        'title' => 'required',
        'content' => 'required',
    ];

    public function __construct(Work $content)
    {
    }

    /**
     * @return mixed
     */
    public function all()
    {

    }
    public function find($id)
    {

    }
    public function getBySlug($slug)
    {

    }
    public function create($attributes)
    {
    }
    public function update($id, $attributes)
    {
    }
    public function delete($id)
    {
        $content = $this->content->findOrFail($id);
        $content->tags()->detach();
        $content->delete();
    }
}
