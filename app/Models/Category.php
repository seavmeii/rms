<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    // A category has many foods
    public function foods()
    {
        return $this->hasMany(Food::class);
    }
}