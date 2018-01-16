<?php

namespace Fully\Http\Controllers\Admin;

use Fully\Models\Content;
use Fully\Repositories\Content\ContentInterface;
use Illuminate\Http\Request;

use Fully\Http\Controllers\Controller;
use Laracasts\Flash\Flash;



use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use Validator;
use Response;
use Str;
use Event;
use Image;
use File;
use Fully\Repositories\RepositoryAbstract;


class ContentController extends Controller
{
    protected $content;

    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    public function index()
    {
        $contents = Content::paginate(10);
        return view('backend.content.index', compact('contents'));
    }

    //  public function create()
    // {
    //     return view('backend.content.create');
    // }

//     public function store(Request $request)
//     {
// //        dd($request);
//         $this->validate($request, [
//             'title' => 'required',
//             'term' => 'required',
//             'content_image' => 'mimes:jpeg,jpg,png,gif'
//         ]);
//         $allcontents = $request->all();
//        dd($allcontents);
//        foreach ($allcontents['allcontent'] as $count => $content_data)
//        {
//
//            if ($content_data['content_image'] !== null)
//            {
//                $upload_success = null;
//                $image = $content_data['content_image'];
//                $image_name = $image->getClientOriginalName();
//                $destination_path = public_path('uploads/content');
//
//                $upload_success = $image->move($destination_path, $image_name);
//                if ($upload_success)
//                {
//                    $allcont0ents['allcontent'][$count]['content_image'] = $content_data['content_image']->getClientOriginalName();
//                }
//                else
//                {
//                    Flash::message('Content couldnot be added. Please try again.');
//                    return langRedirectRoute('admin.content.index');
//                }
//
//            }
//            else
//            {
//                $allcontents['allcontent'][$count]['content_image'] = '';
//            }
//        }
//dd($allcontents);
        // $content = new Content;

        // $content->title = $allcontents['title'];
        // $content->term = $allcontents['term'];
        // $content->intro = $allcontents['intro'];
        // $content->content = serialize($allcontents['allcontent']);

        // $content->save();

    //     Flash::message('Content was successfully added');

    //     return langRedirectRoute('admin.content.index');

    // }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $content = $this->content->find($id);
        $term=$content->term;
        //dd($content->term);
        $contentdata = unserialize($content->content);

        $content->content = $contentdata;
//        dd($content);
        return view('backend.content.edit', compact('content','term'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'term' => 'required',
        ]);
        //dd($request);
        $allcontents = $request->all();
        $content = $this->content->find($id);
        //dd($allcontents,$content);
        //removing hidden field
        if(isset($allcontents['noContent']))
        {
        $serializeContent= array( '1' => 'elem 1', '2'=> 'elem 2', '3'=>' elem 3');
        $content->title = $allcontents['title'];
        $content->term = $allcontents['term'];
        $content->intro = $allcontents['intro'];
        $content->content = serialize($serializeContent);

        $content->save();
        }
        else{
            
       
        $oldImg = array('allcontentOld');
        $filterContent = array_diff_key($allcontents, array_flip($oldImg)); 
        



            foreach ($allcontents['allcontent'] as $count => $content_data)
            {
                $array =  (array) $allcontents['allcontent'][$count]['content_image'];
                //var_dump($array);
               // $a[$count]=$count;
               // dd($content_data['content_image']);
                //dd($array);

                $fileCheck = $content_data['content_image'];
                
                if (! empty($array))
                 {
                    
                         //uploading image
                    $images = Input::file('content_image');
                           
                                        $destinationPath = 'uploads/content/';
                                        $filename = $content_data['content_image']->getClientOriginalName();
                                        $content_data['content_image']->move($destinationPath, $filename);
                                        File::delete($destinationPath .$allcontents['allcontentOld'][$count]['content_imageOld']); // delete image


                    //changing table data
                    $allcontents['allcontent'][$count]['content_image'] = $content_data['content_image']->getClientOriginalName();
                    
                }
                  else{
                   
                        $allcontents['allcontent'][$count]['content_image'] = $allcontents['allcontentOld'][$count]['content_imageOld'];

                    }  
                
            }


          

        

        $content->title = $allcontents['title'];
        $content->term = $allcontents['term'];
        $content->intro = $allcontents['intro'];
        $content->content = serialize($allcontents['allcontent']);

        $content->save();
         }

        $packageTitleForFlash = Input::get('title');
        Flash::message('Content "'.$packageTitleForFlash.'" was successfully updated');

        return langRedirectRoute('admin.content.index');
    }

//     public function confirmDestroy($id)
//     {
//         $content = $this->content->find($id);
// //dd($content);
//         return view('backend.content.confirm-destroy', compact('content'));
//     }

//     public function destroy($id)
//     {
// //        dd('delting');
//         $content = $this->content->find($id);
//         $content->delete($id);

//         Flash::message('Content was successfully deleted');
//         return langRedirectRoute('admin.content.index');

//     }
}