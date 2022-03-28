<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    public function order()
    {
        $this->belongsTo(Order::class);
    }

    protected $fillable = [

        'name',
        'qty',
        'pricePerUnit',
        'pricePerItem'


        ];
}
