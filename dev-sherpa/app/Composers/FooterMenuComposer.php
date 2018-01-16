<?php

namespace Fully\Composers;


use Fully\Repositories\FooterMenu\FooterMenuInterface;

/**
 * Class MenuComposer.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class FooterMenuComposer
{
    /**
     * @var \Fully\Repositories\Menu\MenuInterface
     */
    protected $FooterMenu;

    /**
     * @param MenuInterface $menu
     */
    public function __construct(FooterMenuInterface $FooterMenu)
    {
        $this->FooterMenu = $FooterMenu;
    }

    /**
     * @param $view
     */
    public function compose($view)
    {
        $items = $this->FooterMenu->all(); // all() : CacheDecorator.php
        $parentItems = $this->FooterMenu->parent(); // parent() : CacheDecorator.php

//        $menus = 'sdjfls';
        $footermenus = $this->FooterMenu->getFrontMenuHTML($items,$parentItems);// CacheDecorator.php
       //dd($footermenus);
        $view->with('footermenus', $footermenus);
    }
}
