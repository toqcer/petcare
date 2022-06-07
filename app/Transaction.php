<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'health_packages_id', 'users_id', 'transaction_total', 'transaction_status'
    ];

    protected $hidden = [];

    protected $with = ['health_package'];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transactions_id', 'id');
    }

    public function health_package()
    {
        return $this->belongsTo(HealthPackage::class, 'health_packages_id', 'id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
