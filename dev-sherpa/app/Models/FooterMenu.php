<?php

namespace Fully\Models;

use Fully\Repositories\Destination\DestinationRepository;
use URL;
use Illuminate\Database\Eloquent\Model;
use Fully\Repositories\Page\PageRepository;
use Fully\Repositories\PhotoGallery\PhotoGalleryRepository;
use Fully\Repositories\Package\PackageRepository;
use Fully\Repositories\Region\RegionRepository;
use Fully\Repositories\Activity\ActivityRepository;

/**
 * Class Menu.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 * @author modified by deepesh@view9.com.np
 */
class FooterMenu extends Model
{
    public $table = 'footermenus';
    protected $fillable = ['title', 'url', 'order', 'type', 'selected','footertype'];

    public function getMaxOrder()
    {
        $footermenu = $this->where('lang', getLang())->orderBy('order', 'desc')->first();
        if (isset($footermenu)) {
            return $footermenu->order;
        }

        return 0;
    }

    public function generateMenu($footermenu, $parentId = 0)
    {
        $result = null;

        foreach ($footermenu as $item) {
           
                $imageName = ($item->is_published) ? 'publish_16x16.png' : 'not_publish_16x16.png';

                $result .= "
			    
                    
                    <tr><td>
			        {$item->title}</td>
			        <td><div class='ns-actions'>
                        <a title='Publish FooterMenu' id='{$item->id}' class='footerpublish' href='#'><img id='publish-footerimage-".$item->id."' alt='Publish' src='".url('/').'/assets/images/'.$imageName."'></a>
			            <a title='Edit FooterMenu' class='edit-footermenu' href='".langRoute('admin.footermenu.edit', $item->id)."'><img alt='Edit' src='".url('/').'/assets/images/edit.png'."'></a>
			            <a class='delete-footermenu' href='".URL::route('admin.footermenu.delete', $item->id)."'><img alt='Delete' src='".url('/').'/assets/images/cross.png'."'></a><input type='hidden' value='1' name='menu_id'>
			        </td></tr>
			";
            
        }

        return $result ? "\n<ol class=\"dd-list\">\n$result</ol>\n" : null;
    }

    public function getMenuHTML($items)
    {
        return $this->generateMenu($items);
    }

     public function parseJsonArray($jsonArray, $parentID = 0)
    {
        $return = array();

        foreach ($jsonArray as $subArray) {
            $returnSubArray = array();

            if (isset($subArray['children'])) {
                $returnSubArray = $this->parseJsonArray($subArray['children'], $subArray['id']);
            }

            $return[] = array('id' => $subArray['id'], 'parentID' => $parentID);
            $return = array_merge($return, $returnSubArray);
        }

        return $return;
    }

    public function changeParentById($data)
    {
        foreach ($data as $k => $v) {
            $item = $this->find($v['id']);
            $item->parent_id = $v['parentID'];
            $item->order = $k + 1;
            $item->save();
        }
    }

    public function hasChildItems($id)
    {
        $count = $this->where('parent_id', $id)->where('lang', getLang())->where('is_published', 1)->get()->count();
        if ($count === 0) {
            return false;
        }

        return true;
    }
    public function getChildItems($id)
    {
        $childItems = $this->where('parent_id', $id)->where('lang', getLang())->get();
        
        return $childItems;
    }

     public function getMenuOptions()
    {
        $opts = array();
        $page = new PageRepository(new Page());
        $pageOpts = $page->lists();

        foreach ($pageOpts as $k => $v) {
            $opts['Page']['Fully\Models\Page-'.$k] = $v;
        }

        $destination = new DestinationRepository(new Destination());
        $destinationOpts = $destination->lists();
        foreach ($destinationOpts  as $k => $v) {
            $opts['Destination']['Fully\Models\Destination-'.$k] = $v;
        }

        $photoGallery = new PhotoGalleryRepository(new PhotoGallery());
        $photoGalleryOpts = $photoGallery->lists();

        foreach ($photoGalleryOpts as $k => $v) {
            $opts['PhotoGallery']['Fully\Models\PhotoGallery-'.$k] = $v;
        }

        $activity = new ActivityRepository(new Activity());
        $activityOpts = $activity->lists();
        foreach ($activityOpts  as $k => $v) {
            $opts['Activity']['Fully\Models\Activity-'.$k] = $v;
        }

        $region = new RegionRepository(new Region());
        $regionOpts = $region->lists();
        foreach ($regionOpts  as $k => $v) {
            $opts['Region']['Fully\Models\Region-'.$k] = $v;
        }

        $menuOptions = array(
            'General' => array(
                'home' => 'Home',
                // 'news' => 'News',
                // 'blog' => 'Blog',
                // 'project' => 'Project',
                // 'faq' => 'Faq',
                'contact' => 'Contact Us', 
                'aboutus' => 'About Us', ),
                // 'Page' => (isset($opts['Page']) ? $opts['Page'] : array()),
                'All Destination' => array('alldestination' => 'All Destination',),
                'Destination' => (isset($opts['Destination']) ? $opts['Destination'] : array()),
                'All Activities' => array('allactivity' => 'All Activity',),
                'Activities' =>(isset($opts['Activity']) ? $opts['Activity'] : array()),
                'Regions' =>(isset($opts['Region']) ? $opts['Region'] : array()),
                // 'Photo Gallery' => (isset($opts['PhotoGallery']) ? $opts['PhotoGallery'] : array()), 
                );

        return $menuOptions;
    }


     public function getMenuOptionsPackage()
    {
        $opts = array();
        // $page = new PackageRepository(new Package());
        $package = new PackageRepository(new Package());
        $packageOpts = $package->lists();

        foreach ($packageOpts as $k => $v) {
            $opts['Package']['Fully\Models\Package-'.$k] = $v;
        }

       
        $menuOptionsPackage = array(
            'General' => array(
                'packages' => 'All packages',
                 ),
                'Package' => (isset($opts['Package']) ? $opts['Package'] : array()));

        return $menuOptionsPackage;
    }





    public function getUrl($option)
    {
        $url = '';

        switch ($option) {

            case 'home':
                $url = '/';
                break;
            case 'news':
                $url = '/news';
                break;
            case 'blog':
                $url = '/article';
                break;
            case 'project':
                $url = '/project';
                break;
            case 'faq':
                $url = '/faq';
                break;
            case 'contact':
                $url = '/contact';
                break;
             case 'alldestination':
                $url = '/destinations';
                break;
            case 'allactivity':
                $url = '/destination/all';
                break;
            case 'aboutus':
                $url = '/page/about-us';
                break;
            default:
                $url = $this->getModuleUrl($option);
                break;
        }

        $url = '/'.getLang().'/'.ltrim($url, '/');

        return $url;
    }



    public function getUrlPackage($option)
    {
        $url = '';
        switch ($option) {
            case 'packages':
                $url = '/'.getLang().'/destination/nepal';
                break;
            default:
                $pieces = explode('-', $option); // split option into two
                $reflection = new \ReflectionClass(ucfirst($pieces[0]));
               //dd($pieces[0] . '  ' .$pieces[1]);
                $module = $reflection->newInstance();
                $module = $module::find($pieces[1]);
                //dd($module['attributes']['slug']);
                $slug = $module['attributes']['slug'];
                $url = '/'.getLang().'/'.'packages'.'/'.$slug;
                break;
        }
        
        return $url;
    }



    public function getModuleUrl($option)
    {
        $pieces = explode('-', $option); // split option into two
        $reflection = new \ReflectionClass(ucfirst($pieces[0]));
       //dd($pieces[0] . '  ' .$pieces[1]);


        $module = $reflection->newInstance();
        $module = $module::find($pieces[1]);
        return $module->url;
    }


    public function generateFrontMenu($footermenu,$parent, $parentId = 0, $starter = false)
    {
       
    }

    public function getFrontMenuHTML($items)
    {
        return $this->generateFrontMenu($items, 0, true);
    }

    public function deleteChild($items)
    {
        foreach ($items as $item) 
        {
          $item->delete();
        }
    }


   }
