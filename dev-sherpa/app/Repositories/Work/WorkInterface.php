<?php

namespace Fully\Repositories\Content;

use Fully\Repositories\RepositoryInterface;

/**
 * Interface ContentInterface.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
interface ContentInterface extends RepositoryInterface
{
    /**
     * @param $slug
     *
     * @return mixed
     */
    public function getBySlug($slug);
}
