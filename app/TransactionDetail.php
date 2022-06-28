<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'transactions_id', 'pet_name', 'queue', 'pet', 'package_date', 'estimation_time','finished_at',
    ];

    protected $hidden = [

    ];

    protected $casts = [
        'finished_at' => 'datetime',
        'estimation_time' => 'datetime',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactions_id', 'id');
    }
}
