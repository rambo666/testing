<?php

namespace Fully\Repositories\Content;

use Fully\Models\Content;
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
 * Class ContentRepository.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class ContentRepository
    extends RepositoryAbstract implements ContentInterface, CrudableInterface
{
    public function __construct(Content $content)
    {

    }

    /**
     * @return mixed
     */
    public function all()
    {

    }

    public function getLastContent($limit)
    {

    }

    public function lists()
    {


    }

    public function paginate($page = 1, $limit = 10, $all = false)
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

    }

    public function togglePublish($id)
    {

    }

    public function getUrl($id)
    {

    }

    protected function totalContents($all = false)
    {

    }
}
