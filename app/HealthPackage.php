<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HealthPackage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'caption', 'about', 'perfume', 'vitamin', 
        'snack', 'duration', 'package_name', 'price'
    ];

    protected $hidden = [

    ];

    public function galleries(){
        return $this->hasMany(Gallery::class, 'health_packages_id', 'id');
    }
}
