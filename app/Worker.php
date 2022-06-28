<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    public function transactionDetails ()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
