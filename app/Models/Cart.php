<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['quantity','product_id','customer_id'];

    public function productInfo()
    {
        return $this->belongsTo(Inventory::class,'product_id');
    }
}
