<?php

namespace Fully\Http\Controllers\Admin;

use Fully\Http\Controllers\Controller;
use View;
use Validator;
use Redirect;
use Input;
use Fully\Models\Menu;
use Fully\Models\Package;
use Fully\Models\FooterMenu;
use URL;
use Exception;
use Response;
use Flash;

/**
 * Class MenuController.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class MenuController extends Controller
{
    protected $menu;
    protected $package;


    public function __construct(Menu $menu, Package $package, FooterMenu $footermenu)
    {
        $this->menu = $menu;
        $this->package = $package;
        $this->footermenu = $footermenu;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items = $this->menu->orderBy('order', 'asc')->where('lang', getLang())->get();
        $menus = $this->menu->getMenuHTML($items);

        $footeritems = $this->footermenu->orderBy('order', 'asc')->where('parent_id', 0)->where('lang', getLang())->get();
        $footermenus = $this->footermenu->getMenuHTML($footeritems);

        return view('backend.menu.index', compact('menus','footermenus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $options = $this->menu->getMenuOptions(); // Menu.php
        $optionsPackage = $this->menu->getMenuOptionsPackage(); // Menu.php
//dd($options);
        return view('backend.menu.create', compact('options','optionsPackage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
   public function store()
    {
        // to change the menu url to to Destination Model
        
        $formData = Input::all();
        //dd($formData);
        if ($formData['type'] == 'module') {
            $option = $formData['option'];
        //dd($option);
            $url = $this->menu->getUrl($option); // Menu.php : register all menu links
//            dd($url);
            $formData['url'] = $url;
        }
        //packages
        elseif ($formData['type'] == 'packages') {
            $optionPackage = $formData['optionPackage'];
            //dd($optionPackage);
            $url = $this->menu->getUrlPackage($optionPackage); // Menu.php : register all menu links
           //dd($url);
            $formData['url'] = $url;
            $option = $formData['optionPackage'];
        }
         else if ($formData['type'] == 'custom') {
       $option =null;}
//        dd($option);
        $host = $_SERVER['SERVER_NAME'];
        $urlInfo = parse_url($formData['url']);
        //dd($host,$urlInfo,$formData);
        $rules = array(
            'title' => 'required',
            'url' => 'required',
        );
        $validation = Validator::make($formData, $rules);
        if ($validation->fails()) {
            return langRedirectRoute('admin.menu.create')->withErrors($validation)->withInput();
        }
        $this->menu->fill($formData);
        $this->menu->order = $this->menu->getMaxOrder() + 1;
        if (isset($urlInfo['host'])) {
            $url = ($host == $urlInfo['host']) ? $urlInfo['path'] : $formData['url'];
            
        } else {
            if ($formData['type'] == 'module') 
            {
                $url = ($formData['type'] == 'module') ? $formData['url'] : 'http://'.$formData['url'];
               
            }
            else
            {
                $url = ($formData['type'] == 'packages') ? $formData['url'] : 'http://'.$formData['url'];
                
            }
        }
        //dd($option);
        $this->menu->lang = getLang();
        $this->menu->url = $url;
        $this->menu->option = $option;
        $this->menu->save();
        Flash::message('Menu was successfully added');
        return langRedirectRoute('admin.menu.index');
    }
    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        return view('menu.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        
        $optionsPackage = $this->menu->getMenuOptionsPackage(); // Menu.php
        $options = $this->menu->getMenuOptions();
        $menu = $this->menu->find($id);

        //dd($menu);
        if ($menu['type']=='custom'){
            
        }
        else{
            $menu['url']='';
        }
        //dd($menu);
        return view('backend.menu.edit', compact('menu', 'options','optionsPackage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $formData = Input::all();
        //dd($formData);
        if ($formData['type'] == 'module') {
            $option = $formData['option'];
            $url = $this->menu->getUrl($option);
            $formData['url'] = $url;
        }

        //packages
        elseif ($formData['type'] == 'packages') {
            $optionPackage = $formData['optionPackage'];
            $formData['option']=$formData['optionPackage'];
            //dd($optionPackage);
            $url = $this->menu->getUrlPackage($optionPackage); // Menu.php : register all menu links
            //dd($url);
            $formData['url'] = $url;

        }
          else if ($formData['type'] == 'custom') {
       $option =null;}

        $host = $_SERVER['SERVER_NAME'];
        $urlInfo = parse_url($formData['url']);
        //dd($urlInfo,$host);
        $rules = array(
            'title' => 'required',
            'url' => 'required',
        );

        $validation = Validator::make($formData, $rules);

        if ($validation->fails()) {
            return langRedirectRoute('admin.menu.create')->withErrors($validation)->withInput();
        }

        //dd($option);
        $this->menu = $this->menu->find($id);
        $this->menu->lang = getLang();
        
        $this->menu->fill($formData);

        if (isset($urlInfo['host'])) {
            //dd($urlInfo['host']);
            $url = ($host == $urlInfo['host']) ? $urlInfo['path'] : $formData['url'];
        } else {
            if ($formData['type'] == 'module') 
            {
                $url = ($formData['type'] == 'module') ? $formData['url'] : 'http://'.$formData['url'];
                $this->menu->url = $url;
            }
            else
            {
                $url = ($formData['type'] == 'packages') ? $formData['url'] : 'http://'.$formData['url'];
                $this->menu->url = $url;
            }
        }

        
        
        $this->menu->save();


        Flash::message('Menu was successfully updated');

        return langRedirectRoute('admin.menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->menu->hasChildItems($id)) {

            //throw new Exception("This menu has sub-menus. Can't delete!");
            Flash::message("There are sub menus of this menu. Can't be deleted!");

            return langRedirectRoute('admin.menu.index');
        }

        $this->menu = $this->menu->find($id);
        $this->menu->delete();
        Flash::message('Menu was successfully deleted');

        return langRedirectRoute('admin.menu.index');
    }

    public function confirmDestroy($id)
    {
        $menu = $this->menu->find($id);

        return view('backend.menu.confirm-destroy', compact('menu'));
    }

    public function save()
    {
        $this->menu->changeParentById($this->menu->parseJsonArray(json_decode(Input::get('json'), true)));

        return Response::json(array('result' => 'success'));
    }

    public function togglePublish($id)
    {
        $this->menu = $this->menu->find($id);
        $this->menu->is_published = ($this->menu->is_published) ? false : true;
        $this->menu->save();

        return Response::json(array('result' => 'success', 'changed' => ($this->menu->is_published) ? 1 : 0));
    }
}
