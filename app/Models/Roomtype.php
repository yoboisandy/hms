<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Roomtype extends Model
{
    use HasFactory;
    protected $fillable = ['type_name', 'description', 'occupancy', 'image', 'price'];

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    // public function roomtype()
    // {
    //     return $this->belongsTo(Book::class);
    // }
}
