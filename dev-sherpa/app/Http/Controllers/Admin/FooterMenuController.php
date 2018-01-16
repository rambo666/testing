<?php

namespace Fully\Http\Controllers\Admin;

use Fully\Http\Controllers\Controller;
use View;
use Validator;
use Redirect;
use Input;
use Fully\Models\FooterMenu;
use Fully\Models\Package;
use URL;
use Exception;
use Response;
use Flash;

/**
 * Class MenuController.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class FooterMenuController extends Controller
{
    protected $menu;
    protected $package;
    protected $footermenu;
    protected $footermenuChilds;
    protected $parentId;


    public function __construct(FooterMenu $footermenu, Package $package)
    {

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
        $items = $this->footermenu->orderBy('order', 'asc')->where('lang', getLang())->get();
        $footermenus = $this->footermenu->getMenuHTML($items);

        return view('backend.footermenu.index', compact('footermenus'));
    }


     /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $options = $this->footermenu->getMenuOptions(); // Menu.php
        $optionsPackage = $this->footermenu->getMenuOptionsPackage(); // FooterMenu.php
        //dd($options);
        return view('backend.footermenu.create', compact('options','optionsPackage'));
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
        $count = count($formData['footertitle']);
        //dd($count,$formData);
        //dd($formData['title']);
        $this->footermenu->title=$formData['title'];
        $this->footermenu->type="PARENT";
        $this->footermenu->url="/";
        $this->footermenu->order="1";
        $this->footermenu->parent_id="0";
        $this->footermenu->lang = getLang();
        $this->footermenu->save();
        $this->parentId = $this->footermenu->id;
        //dd($formData);
        for( $i = 0; $i<$count; $i++ ) {
             $footermenu[$i] = new FooterMenu;
            //var_dump($formData['footertitle'][$i],$formData['type'][$i]);
            //dd($formData['type'][$i]);

            if ($formData['type'][$i] == 'module') {
            $option = $formData['option'][$i];
            //dd($option);
            $url = $footermenu[$i]->getUrl($option); // FooterMenu.php : register all menu links
            //dd($url);
            $formData['url'][$i] = $url;




        }

        //packages
        else if ($formData['type'][$i] == 'packages') {
            $optionPackage = $formData['optionPackage'][$i];
            //dd($optionPackage);
            $url = $footermenu[$i]->getUrlPackage($optionPackage); // FooterMenu.php : register all menu links
           //dd($url);
            $formData['url'][$i] = $url;
            $option = $formData['optionPackage'][$i];
        }
        else if ($formData['type'][$i] == 'custom') {
       $option =null;}
//        dd($option);
        $host = $_SERVER['SERVER_NAME'];
        $urlInfo = parse_url($formData['url'][$i]);
        //dd($urlInfo);
        // $rules = array(
        //     'title' => 'required',
        //     'url' => 'required',
        // );

        // $validation = Validator::make($formData, $rules);

        // if ($validation->fails()) {
        //     return langRedirectRoute('admin.footermenu.create')->withErrors($validation)->withInput();
        // }

        $footermenu[$i]->order = $footermenu[$i]->getMaxOrder() + 1;

        if (isset($urlInfo['host'])) {
            $url = ($host == $urlInfo['host']) ? $urlInfo['path'] : $formData['url'][$i];
        } else {
            if ($formData['type'][$i] == 'module') 
            {
                $url = ($formData['type'][$i] == 'module') ? $formData['url'][$i] : 'http://'.$formData['url'][$i];
            }
            else
            {
                $url = ($formData['type'][$i] == 'packages') ? $formData['url'][$i] : 'http://'.$formData['url'][$i];
            }
        }

        
            $footermenu[$i]->title=$formData['footertitle'][$i];
            $footermenu[$i]->type=$formData['type'][$i];
            $footermenu[$i]->url=$url;
            $footermenu[$i]->parent_id=$this->parentId;
            $footermenu[$i]->option=$option;
            $footermenu[$i]->lang = getLang();
            $footermenu[$i]->save();


        }


        Flash::message('Footer Menu was successfully added');

        $url = URL::route(getlang().'.admin.menu.index') . '#footermenu';
       
        //dd($url);
        return Redirect::to($url);
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
        
        $optionsPackage = $this->footermenu->getMenuOptionsPackage(); // FooterMenu.php
        $options = $this->footermenu->getMenuOptions();
        $footermenu = $this->footermenu->find($id);
        $footermenuChilds = $this->footermenu->getChildItems($id);
        //dd($footermenuChilds);
        foreach ($footermenuChilds as $key=>$footermenuChild) 
        {
            //dd($footermenuChild['type']);
        
        if ($footermenuChild['type']=='custom')
        {
            
        }
        else
        {
            $footermenuChild['url']='';
        }
        //print_r($footermenuChild['url'] );
        }
       return view('backend.footermenu.edit', compact('footermenu','footermenuChilds', 'options','optionsPackage'));
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
       if (!isset($formData['type'])) {
        $optionsPackage = $this->footermenu->getMenuOptionsPackage(); // FooterMenu.php
        $options = $this->footermenu->getMenuOptions();
        $footermenu = $this->footermenu->find($id);
        $footermenuChilds = $this->footermenu->getChildItems($id);
        Flash::message('Please Add atleast one menu link');

        return view('backend.footermenu.edit', compact('footermenu','footermenuChilds', 'options','optionsPackage'));
    
       }
       else{
                 
          $this->footermenu = $this->footermenu->find($id);
            //dd($this->footermenu);
            $this->footermenu->delete();
            $childRows=$this->footermenu->getChildItems($id);
            $this->footermenu->deleteChild($childRows);

         
        $count = count($formData['footertitle']);

        //dd($count,$formData,$formData['footertitle'][0]);
        //dd($formData['title']);
        $this->footermenu->title=$formData['title'];
        $this->footermenu->type="PARENT";
        $this->footermenu->url="/";
        $this->footermenu->order="1";
        $this->footermenu->parent_id="0";
        $this->footermenu->lang = getLang();
        $this->footermenu->save();
        $this->parentId = $this->footermenu->id;
        //dd($formData);
        for( $i = 0; $i<$count; $i++ ) {
             $footermenu[$i] = new FooterMenu;
            //var_dump($formData['footertitle'][$i],$formData['type'][$i]);
            //dd($formData['type'][$i]);

            if ($formData['type'][$i] == 'module') {
            $option = $formData['option'][$i];
            //dd($option);
            $url = $footermenu[$i]->getUrl($option); // FooterMenu.php : register all menu links
            //dd($url);
            $formData['url'][$i] = $url;


        }

        //packages
        else if ($formData['type'][$i] == 'packages') {
            $optionPackage = $formData['optionPackage'][$i];
            //dd($optionPackage);
            $url = $footermenu[$i]->getUrlPackage($optionPackage); // FooterMenu.php : register all menu links
           //dd($url);
            $formData['url'][$i] = $url;
            $option = $formData['optionPackage'][$i];
        }
        else if ($formData['type'][$i] == 'custom') {
       $option =null;}
//        dd($option);
        $host = $_SERVER['SERVER_NAME'];
        $urlInfo = parse_url($formData['url'][$i]);
       
        
        $footermenu[$i]->order = $footermenu[$i]->getMaxOrder() + 1;

        if (isset($urlInfo['host'])) {
            $url = $formData['url'][$i];
        } else {
            if ($formData['type'][$i] == 'module') 
            {
                $url = ($formData['type'][$i] == 'module') ? $formData['url'][$i] : 'http://'.$formData['url'][$i];
            }
            else
            {
                $url = ($formData['type'][$i] == 'packages') ? $formData['url'][$i] : 'http://'.$formData['url'][$i];
            }
        }

        
            $footermenu[$i]->title=$formData['footertitle'][$i];
            $footermenu[$i]->type=$formData['type'][$i];
            $footermenu[$i]->url=$url;
            $footermenu[$i]->parent_id=$this->parentId;
            $footermenu[$i]->option=$option;
            $footermenu[$i]->lang = getLang();
            $footermenu[$i]->save();


        }


        Flash::message('Footer Menu was successfully updated');
        $url = URL::route(getlang().'.admin.menu.index') . '#footermenu';
       
        //dd($url);
        return Redirect::to($url);
     } //end of else statement
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
        if ($this->footermenu->hasChildItems($id)) {

            $this->footermenu = $this->footermenu->find($id);
            //dd($this->footermenu);
            $this->footermenu->delete();
            $childRows=$this->footermenu->getChildItems($id);
            $this->footermenu->deleteChild($childRows);
            //throw new Exception("This menu has sub-menus. Can't delete!");
            Flash::message('Footer Menu and sub-menus was successfully deleted');

            $url = URL::route(getlang().'.admin.menu.index') . '#footermenu';
            return Redirect::to($url);
        }

        $this->footermenu = $this->footermenu->find($id);
        $this->footermenu->delete();
        Flash::message('Footer Menu was successfully deleted');

        $url = URL::route(getlang().'.admin.menu.index') . '#footermenu';
        return Redirect::to($url);
    }

    public function confirmDestroy($id)
    {
        $footermenu = $this->footermenu->find($id);

        return view('backend.footermenu.confirm-destroy', compact('footermenu'));
    }

    public function save()
    {
        $this->footermenu->changeParentById($this->footermenu->parseJsonArray(json_decode(Input::get('json'), true)));

        return Response::json(array('result' => 'success'));
    }

    public function togglePublish($id)
    {
        $this->footermenu = $this->footermenu->find($id);
        $this->footermenu->is_published = ($this->footermenu->is_published) ? false : true;
        $this->footermenu->save();

        return Response::json(array('result' => 'success', 'changed' => ($this->footermenu->is_published) ? 1 : 0));
    }
}
