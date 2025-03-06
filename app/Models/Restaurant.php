<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $casts = [
        'opening_time' => 'datetime:H:i',  // **ĐẢM BẢO CÓ DÒNG NÀY HOẶC `'datetime'`**
        'closing_time' => 'datetime:H:i',  // **ĐẢM BẢO CÓ DÒNG NÀY HOẶC `'datetime'`**
    ];


    protected $fillable = [
        'name',
        'description',
        'address',
        'phone_number',
        'opening_time',
        'closing_time',
        'image',
    ];

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
