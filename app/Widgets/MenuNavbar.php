<?php

namespace App\Widgets;

use App\Models\Menu;
use Arrilot\Widgets\AbstractWidget;
use Request;

class MenuNavbar extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function run()
    {
        $menus = Menu::getMenu('main');
        
        foreach ($menus as $menu) {
            $menu->url = $menu->url();

            //if (Request::url() == $menu->url || preg_match('@^'. $menu->url .'@', Request::url())) {
            if (Request::url() == $menu->url) {
                $menu->active = true;
            }
        }

        return view('widgets.menu.menu_navbar', [
            'menus' => $menus
        ]);
    }
}
