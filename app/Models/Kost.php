<?php

namespace App\Models;

use App\Models\Review;
use App\Models\KostGambar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kost extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function gambars()
    {
        return $this->hasMany(KostGambar::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
