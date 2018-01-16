<?php

namespace Fully\Repositories\Package;

use Fully\Repositories\RepositoryInterface;

/**
 * Interface PackageInterface.
 *
 */
interface PackageInterface extends RepositoryInterface
{
    /**
     * @param $slug
     *
     * @return mixed
     */
    public function getBySlug($slug);
}
