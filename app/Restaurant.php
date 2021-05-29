<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    //
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'code',
        'phone',
        'desc',
    ];

    public function image()
    {
        return $this->hasOne(RestaurantImage::class);
    }
}
