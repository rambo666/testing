<?php

namespace Fully\Repositories;

use Fully\Http\Requests\Request;
use Validator as V;

/**
 * Class AbstractValidator.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
abstract class AbstractValidator
{
    /**
     * @var
     */
    protected $errors;

    /**
     * Check valid attributes.
     *
     * @param array $attributes
     * @param array $rules
     *
     * @return bool
     */
    public function isValid(array $attributes, array $rules = null)
    {
        $v = V::make($attributes, ($rules) ? $rules : static::$rules);

        if ($v->fails()) {
            $this->setErrors($v->messages());

            return false;
        }

        return true;
    }

    public function isUpdateValid($id, array $attributes, array $updaterules = null)
    {
        $updaterules = [
            'name' => "required|min:3|unique:package_categories,name,".$id,
            'description' => 'required'
        ];

        $v = V::make($attributes, ($updaterules) ? $updaterules : static::$updaterules);

        if ($v->fails()) {
            $this->setErrors($v->messages());

            return false;
        }

        return true;
    }

    public function isUpdateValidDestination($id, array $attributes, array $updaterules = null)
    {
        $destupdaterules = [
            'title'         => 'required|unique:destinations,title,'.$id,
            'description'   => 'required',
            'image'         =>  'image|mimes:jpg,jpeg,png|max:4096'
        ];

        $v = V::make($attributes, ($destupdaterules) ? $destupdaterules : static::$destupdaterules);

        if ($v->fails()) {
            $this->setErrors($v->messages());

            return false;
        }

        return true;
    }

     public function isUpdateValidActivity($id, array $attributes, array $updaterules = null)
    {
        $activity_updaterules = [
            'title'         => 'required|unique:activitys,title,'.$id,
            'description'   => 'required',
            'image'         =>  'image|mimes:jpg,jpeg,png|max:4096'
        ];

        $v = V::make($attributes, ($activity_updaterules) ? $activity_updaterules : static::$activity_updaterules);

        if ($v->fails()) {
            $this->setErrors($v->messages());

            return false;
        }

        return true;
    }

     public function isUpdateValidRegion($id, array $attributes, array $updaterules = null)
    {
        $activity_updaterules = [
        'title'         => 'required|unique:activitys,title,'.$id,
        'overview' => 'required',
        'activity' => 'required',
        ];

        $v = V::make($attributes, ($activity_updaterules) ? $activity_updaterules : static::$activity_updaterules);

        if ($v->fails()) {
            $this->setErrors($v->messages());

            return false;
        }

        return true;
    }
 public function isUpdateValidSlider($id, array $attributes, array $updaterules = null)
    {
        $sliderupdaterules = [
            'title'         => 'required|unique:destinations,title,',
            'description'   => 'required',
            'image'         =>  'image|mimes:jpg,jpeg,png|max:4096'
        ];

        $v = V::make($attributes, ($sliderupdaterules) ? $sliderupdaterules : static::$sliderupdaterules);

        if ($v->fails()) {
            $this->setErrors($v->messages());

            return false;
        }

        return true;
    }

    /**
     * Get validation error messages.
     *
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set validation error messages.
     *
     * @param $error
     */
    public function setErrors($error)
    {
        $this->errors = $error;
    }
}
