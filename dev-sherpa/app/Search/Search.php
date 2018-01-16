<?php

namespace Fully\Search;

use Fully\Models\News;
use Fully\Models\Article;
use Fully\Models\Package;
use Fully\Models\PhotoGallery;

/**
 * Class Search.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class Search
{
    public function search($search)
    {
        $newsResult = News::search($search)->get()->toArray();
        $articleResult = Article::search($search)->get()->toArray();
//        dd($articleResult);
//        $packageResult = Package::search($search)->get()->toArray();
//        dd($packageResult);
        $photoGalleryResult = PhotoGallery::search($search)->get()->toArray();
        $result = array_merge($newsResult, $articleResult, $photoGalleryResult);

        return $result;
    }
}
