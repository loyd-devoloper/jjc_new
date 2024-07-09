<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'customer_id',
        'price',
        'payment_type',
        'paymongo_id',
        'status',
        'payment_status',
        'ref',
        'downpayment',
        'checkout_url'
    ];

    public function productInfo()
    {
        return $this->belongsTo(Inventory::class,'product_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class,'order_id','id');
    }
    public function customerInfo()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
