<?php

namespace Fully\Repositories\Menu;

use Fully\Services\Cache\CacheInterface;

/**
 * Class CacheDecorator.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class CacheDecorator extends AbstractMenuDecorator
{
    /**
     * @var \Fully\Services\Cache\CacheInterface
     */
    protected $cache;

    /**
     * Cache key.
     *
     * @var string
     */
    protected $cacheKey = 'menu';

    /**
     * @param MenuInterface  $menu
     * @param CacheInterface $cache
     */
    public function __construct(MenuInterface $menu, CacheInterface $cache)
    {
        parent::__construct($menu);
        $this->cache = $cache; // FullyCache.php
    }

    /**
     * @return mixed
     */
    public function all()
    {
        $key = md5(getLang().$this->cacheKey.'all.menus');
//dd('sad');
//        if ($this->cache->has($key)) {
//            return $this->cache->get($key);
//        }

        $menus = $this->menu->all();

        $this->cache->put($key, $menus);

        return $menus;
    }

    /**
     * @param $menu
     * @param int  $parentId
     * @param bool $starter
     *
     * @return mixed|null|string
     */
    public function generateFrontMenu($menu, $parentId = 0, $starter = false)
    {
//        $key = md5(getLang().$this->cacheKey.$parentId.'.menu.html');// above all();

//        if ($this->cache->has($key)) {
//            return $this->cache->get($key); // back to MenuComposer.php
//        }

        $result = null;
        foreach ($menu as $item) {
            if ($item->parent_id == $parentId) {
                $childItem = $this->hasChildItems($item->id);

                $result .= "<li>
                                <a href='".url($item->url)."'>{$item->title}".'</a>'.$this->generateFrontMenu($menu, $item->id).' 
                            </li>';
            }
        }

        $returnData = $result ? '<ul id="' .(($starter) ? "main-nav" : null ). '" class="' .(($starter) ? "clearfix sm sm-blue" : null ). '">'.$result.'</ul>' : null;

//        $this->cache->put($key, $returnData);

        return $returnData;
    }

    /**
     * @param $items
     *
     * @return mixed|null|string
     */
    public function getFrontMenuHTML($items)
    {
        $menus = $this->generateFrontMenu($items, 0, true);

        return $menus;
    }

    /**
     * @param $id
     *
     * @return bool|mixed
     */
    public function hasChildItems($id)
    {
        $key = md5(getLang().$this->cacheKey.$id.'.has.child');

        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }

        $result = $this->menu->hasChildItems($id);
        $this->cache->put($key, $result);

        return $result;
    }
}
