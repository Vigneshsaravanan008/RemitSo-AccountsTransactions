<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Transaction extends Model
{
    protected $guarded=[];
    use HasUuids;
    
    public function account()
    {
        return $this->belongsTo(Account::class,'account_id','id');
    }
}
