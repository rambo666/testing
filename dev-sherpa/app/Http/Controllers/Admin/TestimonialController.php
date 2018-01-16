<?php

namespace Fully\Http\Controllers\Admin;

use Fully\Exceptions\Validation\ValidationException;
use Fully\Models\Testimonial;
use Fully\Repositories\Testimonial\TestimonialInterface;
use Illuminate\Http\Request;

use Fully\Http\Requests;
use Fully\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

class TestimonialController extends Controller
{
    protected $testimonial;

    public function __construct(Testimonial $testimonial)
    {
        $this->testimonial = $testimonial;
    }

    public function index()
    {

        $testimonials = Testimonial::paginate(8);
        return view('backend.testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('backend.testimonial.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'person_name'   => 'required|max:255',
            'review'        => 'required'
        ]);

        $testimonial = new Testimonial;

        $testimonial->person_name = $request->person_name;
        $testimonial->person_address = $request->person_address;
        $testimonial->review = $request->review;
        $testimonial->save();

        Flash::message('Testimonial was successfully added.');

        return langRedirectRoute('admin.testimonial.index');

    }

    public function show($id)
    {
        $testimonial = Testimonial::find($id);
        return view('backend.testimonial.show', compact('testimonial'));
    }

    public function edit($id)
    {
        $testimonial = Testimonial::find($id);
        return view('backend.testimonial.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'person_name'   => 'required|max:255',
            'review'        => 'required'
        ]);

        $testimonial = Testimonial::find($id);

        $testimonial->person_name = $request->person_name;
        $testimonial->person_address = $request->person_address;
        $testimonial->review = $request->review;
        $testimonial->save();

        Flash::message('Testimonial was successfully updated');

        return langRedirectRoute('admin.testimonial.index');
    }

    public function confirmDestroy($id)
    {
        $testimonial = $this->testimonial->find($id);
//        $testimonial = Testimonial::find($id);

        return view('backend.testimonial.confirm-destroy', compact('testimonial'));
    }

    public function destroy($id)
    {
        $testimonial = $this->testimonial->find($id);
        $testimonial->delete($id);
        Flash::message('Testimonial was successfully deleted');

        return langRedirectRoute('admin.testimonial.index');
    }
}
