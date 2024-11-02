<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'city',
        'address1',
        'address2',
        'payment',
        'delivery_status',
        'product_name',
        'product_img',
        'price',
        'total',
        'quantity',
    ];

}
