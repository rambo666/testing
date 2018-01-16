<?php

namespace Fully\Http\Requests;

use Fully\Http\Requests\Request;

class PackageRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title'     => 'required',
//            'overview'     => 'required',
        ];

//        dd($this->request->get('incexc'));
        foreach($this->request->get('itinerary') as $count => $single)
        {
//            foreach ( $single as $key => $value )
//            $rules['itinerary[' . $count .'][daytitle]'] = 'required';
//            $rules['itinerary[' . $count .'][daydetails]'] = 'required';
//            $rules['itinerary[' . $count .'][accommodation]'] = 'required';
//            $rules['itinerary[' . $count .'][walkhrs]'] = 'required';
//            $rules['itinerary[' . $count .'][maxaltitude]'] = 'required';
//            $rules['itinerary[' . $count .'][lat]'] = 'required';
//            $rules['itinerary[' . $count .'][lng]'] = 'required';
        }

//        foreach ( $this->request->get( 'incexc' ) as $count => $single )
//        {
////            dd($count);
//        }
//        dd( $rules );
        return $rules;
    }
}
