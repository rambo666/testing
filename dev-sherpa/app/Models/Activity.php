<?php

namespace Fully\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Activity extends BaseModel implements SluggableInterface
{
    use SluggableTrait;
    public $table = 'activitys';
    public $timestamps = true;
    protected $fillable = ['title', 'description', 'image', 'meta_keywords', 'meta_description'];
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
        return 'activity/'.$this->attributes['slug'];
    }

    public function destinations()
    {
        return $this->belongsTo('Fully\Models\Destination');
    }

    public function packages()
    {
        return $this->hasMany('Fully\Models\Package');
    }

    public function regions()
    {
        return $this->hasMany('Fully\Models\Region');
    }
}
