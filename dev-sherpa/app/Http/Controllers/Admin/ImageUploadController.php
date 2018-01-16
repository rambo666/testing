<?php

namespace Fully\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Fully\Http\Requests;
use Fully\Http\Controllers\Controller;

class ImageUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $image = $request->file('image');

        // get name
        $image_name = $image->getClientOriginalName();

        // set destination path
        $destination_path = public_path('uploads/content');

        $relative_url = url('uploads/content');

        // move image from temp. location to destination
        $upload_success = $image->move($destination_path, $image_name);
        if ($upload_success) {
            $data['success'] = true;
            $data['path'] = $relative_url. '/' .$image_name;
            $data['image_name'] = $image_name;
            $data['image'] = $image;
            echo json_encode($data);
            exit;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
