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
class Region extends BaseModel implements ModelInterface, SluggableInterface
{
    use SluggableTrait;

    public $table = 'regions';
    public $timestamps = true;
    protected $fillable = ['title', 'overview', 'meta_keywords', 'meta_description','image_path'];
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
        return 'region/'.$this->attributes['slug'];
    }

    public function activitys()
    {
        return $this->belongsTo('Fully\Models\Activity');
    }

    public function packages()
    {
        return $this->hasMany('Fully\Models\Package');
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
