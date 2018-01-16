<?php

namespace Fully\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Fully\Interfaces\ModelInterface as ModelInterface;

/**
 * Class Article.
 *
 * @author Sefa Karagöz <karagozsefa@gmail.com>
 */
class Package extends BaseModel implements ModelInterface, SluggableInterface
{
    use SluggableTrait;

    public $table = 'packages';
    protected $fillable = ['title', 'overview', 'meta_keywords', 'meta_description', 'is_published','is_suggested'];
    protected $appends = ['url'];

    protected $sluggable = array(
        'build_from' => 'title',
        'save_to' => 'slug',
    );

    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = $value;
    }

    public function getUrlAttribute()
    {
        return 'article/'.$this->attributes['slug'];
    }

    public function packagemetas()
    {
        return $this->hasMany('Fully\Models\PackageMeta','package_id');
//        return $this->hasMany('PackageMeta', 'id', 'package_id');
//        return $this->hasMany('PackageMeta', 'packagemeta');
//        return $this->hasMany('Fully\Models\PackageMeta', 'packagemeta');
    }

    public function package_category()
    {
        return $this->belongsToMany('');
    }


     public function regions()
    {
        return $this->belongsTo('Fully\Models\Region');
    }


    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [

        ];
    }
}
