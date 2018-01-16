<?php

namespace Fully\Repositories\FooterMenu;

/**
 * Interface FooterMenuInterface.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
interface FooterMenuInterface
{
    /**
     * Get al data.
     *
     * @return mixed
     */
    public function all();

    public function parent();

    public function child($parentId);


}
