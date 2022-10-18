<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'no_izin',
        'address',
        'lat',
        'long',
        'image'
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function services()
    {
        return $this->hasMany(LaundryService::class);
    }

    function reviews()
    {
        return $this->hasMany(Reviews::class);
    }
}
