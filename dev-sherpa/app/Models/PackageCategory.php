<?php

namespace Fully\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Fully\Interfaces\ModelInterface as ModelInterface;

class PackageCategory extends Model implements ModelInterface, SluggableInterface
{
    use SluggableTrait;

    public $table = 'package_categories'; // @do ctrl+B on Model above
    public $timestamps = false;
    protected $fillable =['name', 'description', 'parent_id'];
    protected $appends = ['url'];

    protected $sluggable = array(
        'build_from' => 'name',
        'save_to' => 'slug',
    );

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = $value;
    }

    /**
     * @return mixed
     */
    public function getUrlAttribute()
    {
        return 'packagecategory'.$this->attributes['slug'];
    }

    public function packages() {
        return $this->hasMany('Fully\Models\Package');
    }

//    public function parent()
//    {
//        return $this->belongsTo('App\PackageCategory', 'parent_id');
//    }
//
//    public function children()
//    {
//        return $this->hasMany('App\PackageCategory', 'parent_id');
//    }

//    public function getSlug()
//    {
//        return 'test-slug';
//    }
//
//    public function sluggify($force = false)
//    {
//        // TODO: Implement sluggify() method.
//    }
//
//    public function resluggify()
//    {
//        // TODO: Implement resluggify() method.
//    }
}
