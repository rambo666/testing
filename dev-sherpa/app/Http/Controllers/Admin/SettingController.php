<?php

namespace Fully\Http\Controllers\Admin;

use Fully\Http\Controllers\Controller;
use Redirect;
use View;
use Input;
use Flash;
use Fully\Models\Setting;
use URL;
use Response;

/**
 * Class SettingController.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class SettingController extends Controller
{
    public function index()
    {
        $obj = (Setting::where('lang', getLang())->first()) ?: new Setting();

        $jsonData = $obj->settings;
        $setting = json_decode($jsonData, true);

        if ($setting === null) {
            $setting = array(
                'site_title' => null,
                'ga_code' => null,
                'meta_keywords' => null,
                'meta_description' => null,
                'facebook_link' => null,
                'twitter_link' => null,
                'instagram_link' => null,
                'youtube_link' => null,
                'logo' => null,
                'copyright' => null,
                'contact_intro' => null,

                'officeone_title' => null,
                'officeone_addr' => null,
                'officeone_mail' => null,
                'officeone_phone' => null,

                'officetwo_title' => null,
                'officetwo_addr' => null,
                'officetwo_mail' => null,
                'officetwo_phone' => null,

                'officethree_title' => null,
                'officethree_addr' => null,
                'officethree_mail' => null,
                'officethree_phone' => null,

                'location1' => null,
                'lat1' => null,
                'lng1' => null,

                'location2' => null,
                'lat2' => null,
                'lng2' => null,

                'location3' => null,
                'lat3' => null,
                'lng3' => null,

                'Homeintro'=>null,
                'Hometitle'=>null,
            );
        }

        View::composer('frontend.layout.layout', function ($view)
        {
            $articles = 'sometingsf';

            $view->with('setting', $articles);
        });

        $tab='#setting';

        return view('backend.setting.setting', compact('setting'))->with('active', 'settings');
    }

    public function save()
    {
        $setting = (Setting::where('lang', getLang())->first()) ?: new Setting();

        $formData = Input::all();
        unset($formData['_token']);
        //dd($formData);
        $json = json_encode($formData);
        $setting->fill(array('settings' => $json, 'lang' => getLang()))->save();

        Flash::message('Settings were successfully updated');

        $url = URL::route('admin.settings') . $formData['settingTab'];
       
        return Redirect::to($url);
      
    }
}
