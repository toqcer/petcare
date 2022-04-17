<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'health_packages_id', 'image'
    ];

    protected $hidden = [

    ];

    public function health_package(){
        return $this->belongsTo(HealthPackage::class, 'health_packages_id', 'id');
    }
}
