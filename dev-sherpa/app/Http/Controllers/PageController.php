<?php

namespace Fully\Http\Controllers;

use Fully\Models\Content;
use Fully\Repositories\Page\PageInterface;
use Fully\Repositories\Page\PageRepository as Page;
use Illuminate\Support\Facades\Response;
use View;
use Illuminate\Support\Facades\DB;

/**
 * Class PageController.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class PageController extends Controller
{
    protected $page;

    public function __construct(PageInterface $page)
    {
        $this->page = $page;
    }

    /**
     * Display page.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
       

        /**
         * FOOTER
         */
        // DESTINATIONS
        $footer_destinations = DB::table('destinations')->take(5)->select('title', 'slug')->get();
        View::share('footer_destinations', $footer_destinations);

        // TESTIMONIAL
        $testimonials = DB::table('testimonials')->get();
        View::share('testimonials', $testimonials);
        
        // SETTINGS
        $settings = DB::table('settings')->where( 'lang', 'en' )->get();
        $settings = json_decode( $settings[0]->settings, true );
        View::share('settings', $settings);

        $page = $this->page->getBySlug($slug);

        View::share('page', $page);

        if ($page === null) {
            return Response::view('errors.missing', array(), 404);
        }

        

        /**
         * ABOUT PAGE
         */
        //WORK
        $work = Content::where('term', 'work')->first();

        if ($work !== null)
        {
            $work = $work->toArray();
            $work['content'] = unserialize($work['content']);
            View::share('work', $work);
        }

        //TEAM
        $team = Content::where('term', 'team')->first();

        if ($team !== null)
        {
            $team = $team->toArray();
            $team['content'] = unserialize($team['content']);

            View::share('team', $team);
        }

        //WHY SHERPA GUIDE
        $whysherpa = Content::where('term', 'whysherpa')->first();

        if ($whysherpa !== null)
        {
            $whysherpa = $whysherpa->toArray();
            $whysherpa['content'] = unserialize($whysherpa['content']);

            View::share('whysherpa', $whysherpa);
        }

        //BANNER
        $banner = Content::where('term', 'banner')->first();

        if ($banner !== null)
        {    
            $banner = $banner->toArray();

            $banner['content'] = unserialize($banner['content']);


            View::share('banner', $banner);
        }

         //WHY SHERPA GUIDE
        $content = Content::where('term', 'content')->first();

        if ($content !== null)
        {
            $content = $content->toArray();
            $content['content'] = unserialize($content['content']);

            View::share('content', $content);
        }

        return view('frontend.page.show',compact('testimonials'))->with([$page]);
    }
}
