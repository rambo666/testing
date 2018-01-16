<?php

namespace Fully\Composers;


use Fully\Repositories\Menu\MenuInterface;

/**
 * Class MenuComposer.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class MenuComposer
{
    /**
     * @var \Fully\Repositories\Menu\MenuInterface
     */
    protected $menu;

    /**
     * @param MenuInterface $menu
     */
    public function __construct(MenuInterface $menu)
    {
        $this->menu = $menu;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        $items = $this->menu->all(); // all() : CacheDecorator.php

//        $menus = 'sdjfls';
        $menus = $this->menu->getFrontMenuHTML($items);// CacheDecorator.php
//        dd($menus);
        $view->with('menus', $menus);
    }
}
