<?php

namespace Fully\Http\Controllers\Admin;

use Fully\Exceptions\Validation\ValidationException;
use Fully\Http\Controllers\Controller;
use Fully\Models\PackageCategory;
use Fully\Repositories\PackageCategory\PackageCategoryInterface;
use Illuminate\Support\Facades\Input;
use Laracasts\Flash\Flash;

/**
 * @see app/Provider/RepositoryServiceProvider
 */

/**
 * Class PackageCategoryController
 * @package Fully\Http\Controllers\Admin
 */

class PackageCategoryController extends Controller
{
    protected $packageCategory;

    public function __construct(PackageCategoryInterface $packageCategory)
    {
        $this->packageCategory = $packageCategory; // @see PackageCategoryInterface.php > PackageCategoryRepository.php
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packageCategories = PackageCategory::all();
        return view('backend.package_category.index', compact('packageCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packageCategories = $this->packageCategory->lists(); //  @see repository
        $packageCategories->prepend('Select Parent', null);
        return view('backend.package_category.create', compact('packageCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store() // removed Request $request
    {
        try {
            $this->packageCategory->create(Input::all()); // @see repo.
            Flash::message('Package category was successfully added');

            return langRedirectRoute('admin.packagecategory.index');
        } catch (ValidationException $e) {
            return langRedirectRoute('admin.packagecategory.create')->withInput()->withErrors($e->getErrors());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $packageCategory = $this->packageCategory->find($id); /* find: repository */
        return view('backend.package_category.show', compact('packageCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get category to edit by current id
        $packageCategory = $this->packageCategory->find($id);

        // all categories for editing parent
        $packageCategories = $this->packageCategory->lists(); //  @see repository
        $packageCategories->prepend('Select Parent', 0);
        return view('backend.package_category.edit', compact('packageCategory', 'packageCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

        try {
            $this->packageCategory->update($id, Input::all());
            Flash::message('Package category was successfully updated');

            return langRedirectRoute('admin.packagecategory.index');
        } catch (ValidationException $e) {
            return redirect()->route(getLang() . '.admin.packagecategory.edit', ['packagecategory' => $id])->withInput()->withErrors($e->getErrors());
//            return langRedirectRoute('admin.packagecategory.edit', ['packagecategory' => $id])->withInput()->withErrors($e->getErrors());
        }
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param int $id
     */
//    public function delete( $id ) {
//        echo 'deleting';
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->packageCategory->delete($id);

        Flash::message('Package Category was successfully deleted.');

        return langRedirectRoute('admin.packagecategory.index');
    }

    public function confirmDestroy($id)
    {
        $packageCategory = $this->packageCategory->find($id);

        return view('backend.package_category.confirm-destroy', compact('packageCategory'));
    }
}
