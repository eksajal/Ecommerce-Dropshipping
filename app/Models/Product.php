<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'category',
        'price',
        'quantity',
        'delivery_charge',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
