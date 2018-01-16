<?php

namespace Fully\Repositories\PackageCategory;

use Fully\Repositories\RepositoryInterface;

/**
 * Interface PackageCategoryInterface.
 *
 * @author Ashish Shrestha <shresthaaashish2@gmail.com>
 */
interface PackageCategoryInterface extends RepositoryInterface
{
    public function lists();
}