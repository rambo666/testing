<?php

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

$languages = LaravelLocalization::getSupportedLocales();
foreach ($languages as $language => $values) {
    $supportedLocales[] = $language;
}

$locale = Request::segment(1);
if (in_array($locale, $supportedLocales)) {
    LaravelLocalization::setLocale($locale);
    App::setLocale($locale);
}

Route::get('/', function () {
    return Redirect::to(LaravelLocalization::getCurrentLocale(), 302);
});

Route::group(array('prefix' => LaravelLocalization::getCurrentLocale(), 'before' => array('localization', 'before')), function () {

    Session::put('my.locale', LaravelLocalization::getCurrentLocale());

    // frontend dashboard
    Route::get('/', ['as' => 'dashboard', 'uses' => 'HomeController@index']);

    // quote ajax
    Route::post('/quoteprocess', array('as' => 'dashboard.quoteprocess', 'uses' => 'QuoteController@process'));

    //send mail
    Route::post('/send', ['as' => 'dashboard.sendmail', 'uses' => 'EmailController@send']);
    Route::post('/booktrip', ['as' => 'dashboard.booktrip', 'uses' => 'EmailController@bookTrip']);

    // article
    Route::get('/article', array('as' => 'dashboard.article', 'uses' => 'ArticleController@index'));
    Route::get('/article/{slug}', array('as' => 'dashboard.article.show', 'uses' => 'ArticleController@show'));

    // PACKAGE
    Route::get('/packages', array('as' => 'dashboard.package', 'uses' => 'PackageController@index'));
    Route::get('/packages/{slug}', array('as' => 'dashboard.package.show', 'uses' => 'PackageController@show'));
    Route::get('/packages/latlng/{slug}', array('as' => 'dashboard.package.getLatLng', 'uses' => 'PackageController@getLatLng'));

     // REGION
    Route::get('/region', array('as' => 'dashboard.region', 'uses' => 'RegionController@index'));
    Route::get('/region/{slug}', array('as' => 'dashboard.region.show', 'uses' => 'RegionController@show')); // region.show.blade.php , list packages of specific destination

    // DESTINATION
    Route::get('/destinations', array('as' => 'dashboard.destination', 'uses' => 'DestinationController@index'));
    Route::get('/destination/{slug}', array('as' => 'dashboard.destination.show', 'uses' => 'DestinationController@show')); // destination.show.blade.php , list activities of specific destination

    // ACTIVITIES
    Route::get('/activity', array('as' => 'dashboard.activity', 'uses' => 'ActivityController@index'));
    Route::get('/activity/{slug}/{destination_slug?}', array('as' => 'dashboard.activity.show', 'uses' => 'ActivityController@show'));

    // PACKAGE CATEGORIES
    Route::get('/packagecategory/{slug}', array(
        'as'    => 'dashboard.packagecategory',
        'uses'  => 'PackageCategoryController@index'
    ));

    // news
    Route::get('/news', array('as' => 'dashboard.news', 'uses' => 'NewsController@index'));
    Route::get('/news/{slug}', array('as' => 'dashboard.news.show', 'uses' => 'NewsController@show'));

    // tags
    Route::get('/tag/{slug}', array('as' => 'dashboard.tag', 'uses' => 'TagController@index'));

    // categories
    Route::get('/category/{slug}', array('as' => 'dashboard.category', 'uses' => 'CategoryController@index'));

    // page
    Route::get('/page', array('as' => 'dashboard.page', 'uses' => 'PageController@index'));
    Route::get('/page/{slug}', array('as' => 'dashboard.page.show', 'uses' => 'PageController@show'));

    // photo gallery
    Route::get('/photo-gallery/{slug}', array('as' => 'dashboard.photo_gallery.show',
                                              'uses' => 'PhotoGalleryController@show', ));

    // video
    Route::get('/video', array('as' => 'dashboard.video', 'uses' => 'VideoController@index'));
    Route::get('/video/{slug}', array('as' => 'dashboard.video.show', 'uses' => 'VideoController@show'));

    // projects
    Route::get('/project', array('as' => 'dashboard.project', 'uses' => 'ProjectController@index'));
    Route::get('/project/{slug}', array('as' => 'dashboard.project.show', 'uses' => 'ProjectController@show'));

    // contact
    Route::get('/contact', array('as' => 'dashboard.contact', 'uses' => 'FormPostController@getContact'));

    // contact ajax
//    Route::get('/processcontact', array('as' => 'dashboard.processContact', 'uses' => 'FormPostController@postContact'));

    // faq
    Route::get('/faq', array('as' => 'dashboard.faq', 'uses' => 'FaqController@show'));

    // rss
    Route::get('/rss', array('as' => 'rss', 'uses' => 'RssController@index'));

    // search
   
    Route::get('/search/searches', ['as' => 'dashboard.search.searches', 'uses' => 'SearchController@searches']);
    Route::get('/search/displaySuggested', ['as' => 'dashboard.search.displaySuggested', 'uses' => 'SearchController@displaySuggested']);
    // language
    // Route::get('/set-locale/{language}', array('as' => 'language.set', 'uses' => 'LanguageController@setLocale'));

    // maillist
    Route::get('/save-maillist', array('as' => 'frontend.maillist', 'uses' => 'MaillistController@getMaillist'));
    Route::post('/save-maillist', array('as' => 'frontend.maillist.post', 'uses' => 'MaillistController@postMaillist'));
});


/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/
//Route::group(array('prefix' => '/admin',
//    'namespace' => 'Admin',
//    'middleware' => ['before', 'sentinel.auth', 'sentinel.permission'] ), function () {
//    Route::resource('destination', 'DestinationController', array('before' => 'hasAccess:destination'));
//});

// IMAGE UPLOAD
Route::post('en/admin/imageupload', array('uses' => 'Admin\ImageUploadController@upload'));

Route::group(array('prefix' => LaravelLocalization::getCurrentLocale()), function () {

    Route::group(array('prefix' => '/admin',
                       'namespace' => 'Admin',
                       'middleware' => ['before', 'sentinel.auth', 'sentinel.permission'] ), function () { // auth = stop directly accessing admin

//      admin dashboard
        Route::get('/', array('as' => 'admin.dashboard', 'uses' => 'DashboardController@index'));

//      REGION
        Route::get('/region/changeActivity', ['as' => 'dashboard.region.changeActivity', 'uses' => 'RegionController@changeActivity']);
        Route::get('/region/changeActivitySecond', ['as' => 'dashboard.region.changeActivitySecond', 'uses' => 'RegionController@changeActivitySecond']);
        Route::resource('region', 'RegionController', array('before' => 'hasAccess:region'));
        Route::get('region/{id}/delete', array('as' => 'admin.region.delete',
            'uses' => 'RegionController@confirmDestroy', ))->where('id', '\d+');

//      PACKAGE
        Route::get('/packages/changeActivity', ['as' => 'dashboard.package.changeActivity', 'uses' => 'PackageController@changeActivity']);
        Route::get('/packages/changeRegion', ['as' => 'dashboard.package.changeRegion', 'uses' => 'PackageController@changeRegion']);
        Route::resource('package', 'PackageController', array('before' => 'hasAccess:package'));
        Route::get('package/{id}/delete', array('as' => 'admin.package.delete',
            'uses' => 'PackageController@confirmDestroy', ))->where('id', '\d+');

//      ACITVITY
        Route::resource('activity', 'ActivityController', array('before' => 'hasAccess:activity'));
        Route::get('activity/{id}/delete', array('as' => 'admin.activity.delete',
            'uses' => 'ActivityController@confirmDestroy', ))->where('id', '\d+');

//      PACKAGE CATEGORY
        Route::resource('packagecategory', 'PackageCategoryController', array('before' => 'hasAccess:packagecategory'));
        Route::get('packagecategory/{id}/delete', array('as' => 'admin.packagecategory.delete',
            'uses' => 'PackageCategoryController@confirmDestroy'));

//      DESTINATIONS
        Route::get('/destination/changeOrdering', ['as' => 'dashboard.destination.changeOrdering', 'uses' => 'DestinationController@changeOrdering']);
        Route::resource('destination', 'DestinationController', array('before' => 'hasAccess:destination'));
        Route::get('destination/{id}/delete', array('as' => 'admin.destination.delete',
            'uses' => 'DestinationController@confirmDestroy'));

//        TESTIMONIAL
        Route::resource('testimonial', 'TestimonialController');
        Route::get('testimonial/{id}/delete', array( 'as' => 'admin.testimonial.delete',
            'uses' => 'TestimonialController@confirmDestroy' ))->where('id', '\d+');

//      CONTENTS
        Route::resource('content', 'ContentController');
        Route::get('content/{id}/delete', array( 'as' => 'admin.content.delete',
            'uses' => 'ContentController@confirmDestroy' ))->where('id', '\d+');

        // user
        Route::resource('user', 'UserController');
        Route::get('user/{id}/delete', array('as' => 'admin.user.delete',
                                             'uses' => 'UserController@confirmDestroy', ))->where('id', '[0-9]+');

        // role
        Route::resource('role', 'RoleController');
        Route::get('role/{id}/delete', array('as' => 'admin.role.delete',
                                              'uses' => 'RoleController@confirmDestroy', ))->where('id', '[0-9]+');

        // blog
        Route::resource('article', 'ArticleController', array('before' => 'hasAccess:article'));
        Route::get('article/{id}/delete', array('as' => 'admin.article.delete',
                                                'uses' => 'ArticleController@confirmDestroy', ))->where('id', '\d+');

        // news
        Route::resource('news', 'NewsController', array('before' => 'hasAccess:news'));
        Route::get('news/{id}/delete', array('as' => 'admin.news.delete',
                                             'uses' => 'NewsController@confirmDestroy', ))->where('id', '[0-9]+');

        // category
        Route::resource('category', 'CategoryController', array('before' => 'hasAccess:category'));
        Route::get('category/{id}/delete', array('as' => 'admin.category.delete',
                                                 'uses' => 'CategoryController@confirmDestroy', ))->where('id', '[0-9]+');




        // faq
        Route::resource('faq', 'FaqController', array('before' => 'hasAccess:faq'));
        Route::get('faq/{id}/delete', array('as' => 'admin.faq.delete',
                                            'uses' => 'FaqController@confirmDestroy', ))->where('id', '[0-9]+');

        // project
        Route::resource('project', 'ProjectController');
        Route::get('project/{id}/delete', array('as' => 'admin.project.delete',
                                                'uses' => 'ProjectController@confirmDestroy', ))->where('id', '[0-9]+');

        // page
        Route::resource('page', 'PageController');
        Route::get('page/{id}/delete', array('as' => 'admin.page.delete',
                                             'uses' => 'PageController@confirmDestroy', ))->where('id', '[0-9]+');

        // photo gallery
        Route::resource('photo-gallery', 'PhotoGalleryController');
        Route::get('photo-gallery/{id}/delete', array('as' => 'admin.photo-gallery.delete',
                                                      'uses' => 'PhotoGalleryController@confirmDestroy', ))->where('id', '[0-9]+');

        // video
        Route::resource('video', 'VideoController');
        Route::get('video/{id}/delete', array('as' => 'admin.video.delete',
                                              'uses' => 'VideoController@confirmDestroy', ))->where('id', '[0-9]+');
        Route::post('/video/get-video-detail', array('as' => 'admin.video.detail',
                                                     'uses' => 'VideoController@getVideoDetail', ))->where('id', '[0-9]+');

        // ajax - PACKAGE
        Route::post('package/{id}/toggle-publish', array('as' => 'admin.package.toggle-publish',
                                                         'uses' => 'PackageController@togglePublish', ))->where('id', '[0-9]+');

        // ajax - blog
        Route::post('article/{id}/toggle-publish', array('as' => 'admin.article.toggle-publish',
                                                         'uses' => 'ArticleController@togglePublish', ))->where('id', '[0-9]+');

        // ajax - news
        Route::post('news/{id}/toggle-publish', array('as' => 'admin.news.toggle-publish',
                                                      'uses' => 'NewsController@togglePublish', ))->where('id', '[0-9]+');

        // ajax - photo gallery
        Route::post('photo-gallery/{id}/toggle-publish', array('as' => 'admin.photo_gallery.toggle-publish',
                                                               'uses' => 'PhotoGalleryController@togglePublish', ))->where('id', '[0-9]+');
        Route::post('photo-gallery/{id}/toggle-menu', array('as' => 'admin.photo_gallery.toggle-menu',
                                                            'uses' => 'PhotoGalleryController@toggleMenu', ))->where('id', '[0-9]+');

        // ajax - page
        Route::post('page/{id}/toggle-publish', array('as' => 'admin.page.toggle-publish',
                                                      'uses' => 'PageController@togglePublish', ))->where('id', '[0-9]+');
        Route::post('page/{id}/toggle-menu', array('as' => 'admin.page.toggle-menu',
                                                   'uses' => 'PageController@toggleMenu', ))->where('id', '[0-9]+');

        // ajax - form post
        Route::post('form-post/{id}/toggle-answer', array('as' => 'admin.form-post.toggle-answer',
                                                          'uses' => 'FormPostController@toggleAnswer', ))->where('id', '[0-9]+');

        // file upload photo gallery
        Route::post('/photo-gallery/upload/{id}', array('as' => 'admin.photo.gallery.upload.image',
                                                        'uses' => 'PhotoGalleryController@upload', ))->where('id', '[0-9]+');
        Route::post('/photo-gallery-delete-image', array('as' => 'admin.photo.gallery.delete.image',
                                                         'uses' => 'PhotoGalleryController@deleteImage', ));

        // settings
        Route::get('/settings', array('as' => 'admin.settings', 'uses' => 'SettingController@index'));
        Route::post('/settings', array('as' => 'admin.settings.save',
                                       'uses' => 'SettingController@save', ), array('before' => 'csrf'));

        // form post
        Route::resource('form-post', 'FormPostController', array('only' => array('index', 'show', 'destroy')));
        Route::get('form-post/{id}/delete', array('as' => 'admin.form-post.delete',
                                                  'uses' => 'FormPostController@confirmDestroy', ))->where('id', '[0-9]+');

        // slider
        Route::get('/slider', array(
            'as' => 'admin.slider',
            function () {

                return View::make('backend/slider/index');
            }, ));

        // slider
        Route::resource('slider', 'SliderController');
        Route::get('slider/{id}/delete', array('as' => 'admin.slider.delete',
                                               'uses' => 'SliderController@confirmDestroy', ))->where('id', '[0-9]+');

        // file upload slider
        Route::post('/slider/upload/{id}', array('as' => 'admin.slider.upload.image',
                                                 'uses' => 'SliderController@upload', ))->where('id', '[0-9]+');
        Route::post('/slider-delete-image', array('as' => 'admin.slider.delete.image',
                                                  'uses' => 'SliderController@deleteImage', ));

        // menu-managment
        Route::resource('menu', 'MenuController');
        Route::post('menu/save', array('as' => 'admin.menu.save', 'uses' => 'MenuController@save'));
        Route::get('menu/{id}/delete', array('as' => 'admin.menu.delete',
                                             'uses' => 'MenuController@confirmDestroy', ))->where('id', '[0-9]+');
        Route::post('menu/{id}/toggle-publish', array('as' => 'admin.menu.toggle-publish',
                                                      'uses' => 'MenuController@togglePublish', ))->where('id', '[0-9]+');
          // Footer menu-managment
        Route::resource('footermenu', 'FooterMenuController');
        Route::post('footermenu/save', array('as' => 'admin.footermenu.save', 'uses' => 'FooterMenuController@save'));
        Route::get('footermenu/{id}/delete', array('as' => 'admin.footermenu.delete',
                                             'uses' => 'FooterMenuController@confirmDestroy', ))->where('id', '[0-9]+');
        Route::post('footermenu/{id}/toggle-publish', array('as' => 'admin.footermenu.toggle-publish',
                                                      'uses' => 'FooterMenuController@togglePublish', ))->where('id', '[0-9]+');

        // log
        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

        // language
        Route::get('language/set-locale/{language}', array('as' => 'admin.language.set',
                                                           'uses' => 'LanguageController@setLocale', ));
    });
});

Route::post('/en/contact', array('as' => 'dashboard.contact.post',
                              'uses' => 'FormPostController@postContact', ), array('before' => 'csrf'));

// filemanager
Route::get('filemanager/show', function () {

    return View::make('backend/plugins/filemanager');
})->before('sentinel.auth');

// login
Route::get('/admin/login', array(
    'as' => 'admin.login',
    function () {

        return View::make('backend/auth/login');
    }, ));

Route::group(array('namespace' => 'Admin'), function () {

    // admin auth
    Route::get('admin/logout', array('as' => 'admin.logout', 'uses' => 'AuthController@getLogout'));
    Route::get('admin/login', array('as' => 'admin.login', 'uses' => 'AuthController@getLogin'));
    Route::post('admin/login', array('as' => 'admin.login.post', 'uses' => 'AuthController@postLogin'));

    // admin password reminder
    Route::get('admin/forgot-password', array('as' => 'admin.forgot.password',
                                              'uses' => 'AuthController@getForgotPassword', ));
    Route::post('admin/forgot-password', array('as' => 'admin.forgot.password.post',
                                               'uses' => 'AuthController@postForgotPassword', ));

    Route::get('admin/{id}/reset/{code}', array('as' => 'admin.reset.password',
                                                'uses' => 'AuthController@getResetPassword', ))->where('id', '[0-9]+');
    Route::post('admin/reset-password', array('as' => 'admin.reset.password.post',
                                              'uses' => 'AuthController@postResetPassword', ));
});

/*
|--------------------------------------------------------------------------
| General Routes
|--------------------------------------------------------------------------
*/

// error

// 404 page not found
