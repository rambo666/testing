<?php

namespace Fully\Models;

use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Fully\Interfaces\ModelInterface as ModelInterface;

class PackageMeta extends Model
{
    protected $fillable = ['key', 'value'];
    protected $table = 'packagemeta';
    public $timestamps = false;

    public function packages()
    {
//        return $this->belongsTo('Fully\Model\Package','package_id');
        dd($this->belongsTo('Fully\Model\Package','package_id'));
//        return $this->belongsTo('Package', 'package_id');
//        return $this->belongsTo('Fully\Models\Package', 'packages');

    }

}
