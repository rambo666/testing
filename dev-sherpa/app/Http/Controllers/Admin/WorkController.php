<?php

namespace Fully\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Fully\Http\Controllers\Controller;

class WorkController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('backend.work.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
