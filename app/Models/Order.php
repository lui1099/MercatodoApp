<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [

        'requestId',
        'total'

    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
    public function cartItem() {

        $this->hasMany(CartItem::class);
    }


}
