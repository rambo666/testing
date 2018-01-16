<?php

namespace Fully\Models;

use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Destination extends BaseModel implements SluggableInterface
{
    use SluggableTrait;
    protected $table = 'destinations';
    public $timestamps = true;
    protected $fillable = ['title', 'description', 'image_path'];
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
        return 'destination/'.$this->attributes['slug'];
    }

    /**
     * Get activities for specific destination
     */

    public function activitys()
    {
        return $this->hasMany('Fully\Models\Activity'); // F.K. activity_id
    }

    public function packages()
    {
        return $this->hasMany('Fully\Models\Package'); // F.K : packages.destination_id , related packages table,
//        return $this->hasMany('Fully\Models\Package', 'destination_id'); // F.K : packages.destination_id , related packages table,
//        return $this->hasMany('Fully\Models\Package','package_id'); // package_id insert into packages set package_id = 9
    }

     public function regions()
    {
        return $this->hasMany('Fully\Models\Region');
    }

}
