<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id','otp','status'];
    public function customerInfo()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
