<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

   
protected $fillable = [
    'user_id',
    'quantity',
    'total_price',
    'status',
    'payment_status',
    'tran_id',
    'cart_items',
    'req_time',
];


protected $casts = [
    'cart_items' => 'array',
];


    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}