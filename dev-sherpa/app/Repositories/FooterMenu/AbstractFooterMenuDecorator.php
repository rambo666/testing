<?php

namespace Fully\Repositories\FooterMenu;

/**
 * Class AbstractMenuDecorator.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
abstract class AbstractFooterMenuDecorator implements FooterMenuInterface
{
    /**
     * @var MenuInterface
     */
    protected $footermenu;
    protected $parent;
    protected $child;

    /**
     * @param MenuInterface $menu
     */
    public function __construct(FooterMenuInterface $footermenu)
    {
        $this->footermenu = $footermenu;
    }

    /**
     * @return mixed
     */
    public function all()
    {
       
    }

   

    /**
     * @param $menu
     * @param int  $parentId
     * @param bool $starter
     *
     * @return mixed
     */
    public function generateFrontMenu($footermenu,$parent, $parentId = 0, $starter = false)
    {
        
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function hasChildItems($id)
    {

    }
}
