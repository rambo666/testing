<?php

namespace Fully\Http\Controllers\Admin;

use Fully\Http\Controllers\Controller;
use Fully\Models\FormPost;
use Fully\Models\Package;

/**
 * Class DashboardController.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class DashboardController extends Controller
{
    public function index()
    {
        $packages = Package::orderBy('created_at', 'DESC')->paginate(5);
        $formPosts = FormPost::orderBy('created_at', 'DESC')->where('lang', getLang())->paginate(5);
        return view('backend/layout/dashboard', compact( 'chartData', 'formPosts', 'packages' ))->with('active', 'home');
    }
}
