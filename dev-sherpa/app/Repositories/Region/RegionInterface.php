<?php

namespace Fully\Repositories\Region;

use Fully\Repositories\RepositoryInterface;

/**
 * Interface PackageInterface.
 *
 */
interface RegionInterface extends RepositoryInterface
{
    /**
     * @param $slug
     *
     * @return mixed
     */
    public function getBySlug($slug);
}
