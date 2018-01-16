<?php

namespace Fully\Repositories\Activity;

use Fully\Repositories\RepositoryInterface;

interface ActivityInterface extends RepositoryInterface
{
    public function getBySlug($slug);
}