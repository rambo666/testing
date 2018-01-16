<?php

namespace Fully\Repositories\FooterMenu;

use Fully\Services\Cache\CacheInterface;

/**
 * Class CacheDecorator.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class CacheDecorator extends AbstractFooterMenuDecorator
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
    protected $cacheKey = 'footermenu';

    /**
     * @param MenuInterface  $menu
     * @param CacheInterface $cache
     */
    public function __construct(FooterMenuInterface $footermenu, CacheInterface $cache)
    {
        parent::__construct($footermenu);
        $this->cache = $cache; // FullyCache.php
    }

    /**
     * @return mixed
     */
    public function all()
    {
        $key = md5(getLang().$this->cacheKey.'all.footermenus');
//dd('sad');
//        if ($this->cache->has($key)) {
//            return $this->cache->get($key);
//        }

        $footermenus = $this->footermenu->all();

        $this->cache->put($key, $footermenus);

        return $footermenus;
    }

       public function parent()
    {
        $key = md5(getLang().$this->cacheKey.'parent.footermenus');
//dd('sad');
//        if ($this->cache->has($key)) {
//            return $this->cache->get($key);
//        }

        $footermenus = $this->footermenu->parent();

        $this->cache->put($key, $footermenus);

        return $footermenus;
    }


     public function child($parentId)
    {
        $key = md5(getLang().$this->cacheKey.'parent.footermenus');
//dd('sad');
//        if ($this->cache->has($key)) {
//            return $this->cache->get($key);
//        }

        $footermenus = $this->footermenu->child($parentId);

        $this->cache->put($key, $footermenus);

        return $footermenus;
    }

    /**
     * @param $menu
     * @param int  $parentId
     * @param bool $starter
     *
     * @return mixed|null|string
     */
    public function generateFrontMenu($footermenu,$parent, $parentId = 0, $starter = false)
    {
//        $key = md5(getLang().$this->cacheKey.$parentId.'.menu.html');// above all();

//        if ($this->cache->has($key)) {
//            return $this->cache->get($key); // back to MenuComposer.php
//        }

        $result = null;
        $childResult=null;
        foreach ($parent as $item) {
            $childs = $this->child($item->id);
            //dd($child);
            foreach ($childs as $child) {
                  $childResult .="<li><a href='".url($child->url)."'>{$child->title}</a></li>";  
                }
            $result .="<section class="."col-sm-3 col-xs-6"."><h3 class='text-uppercase' >{$item->title}</h3><ul class='sherpa-lists'>
                 {$childResult}
            </ul></section>
            ";
            
            $childResult=null;
           
        }

      
        return $result;
    }

    /**
     * @param $items
     *
     * @return mixed|null|string
     */
    public function getFrontMenuHTML($items,$parents)
    {
        $footermenus = $this->generateFrontMenu($items,$parents, 0, true);

        return $footermenus;
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

        $result = $this->footermenu->hasChildItems($id);
        $this->cache->put($key, $result);

        return $result;
    }
}
