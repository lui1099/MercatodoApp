<?php

namespace App\Models;

use App\Constants\ImageData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Product extends Model
{
    use HasFactory;

    protected $with = ['image'];

    protected $fillable = [
        'name',
        'category',
        'brand',
        'file_path',
        'price',
        'description',
        'isActive'
    ];

    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function image(): \Illuminate\Database\Eloquent\Relations\hasOne
    {
        return $this->hasOne(Image::class)->oldestOfMany();
    }

    public function getImageContent(): string
    {
        return ImageData::PNG . @$this->image->content;
    }


}
