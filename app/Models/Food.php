<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
     protected $table = 'foods';  

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image', 
    ];

    // A food belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // A food can have many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    
}