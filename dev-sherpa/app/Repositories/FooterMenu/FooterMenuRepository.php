<?php

namespace Fully\Repositories\FooterMenu;

use Fully\Models\FooterMenu;
use Fully\Repositories\RepositoryAbstract;

/**
 * Class MenuRepository.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class FooterMenuRepository extends RepositoryAbstract implements FooterMenuInterface
{
    /**
     * @var \Menu
     */
    protected $footermenu;
    protected $footermenuChild;
    protected $footermenuParent;

    /**
     * @param Menu $menu
     */
    public function __construct(FooterMenu $footermenu)
    {
        $this->footermenu = $footermenu;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->footermenu->where('is_published', 1)->where('lang', $this->getLang())->orderBy('order', 'asc')->get();
    }

    /**
     * @param $menu
     * @param int  $parentId
     * @param bool $starter
     *
     * @return null|string
     */
    public function parent()
    {
        return $this->footermenu->where('parent_id', 0)->where('is_published', 1)->where('lang', $this->getLang())->orderBy('order', 'asc')->get();
    }

        public function child($parentId)
    {
        return $this->footermenu->where('parent_id', $parentId)->where('lang', $this->getLang())->orderBy('order', 'asc')->get();
    }


    public function generateFrontMenu($footermenu, $parentId = 0, $starter = false)
    {
       
    }

    /**
     * @param $items
     *
     * @return null|string
     */
    public function getFrontMenuHTML($items)
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