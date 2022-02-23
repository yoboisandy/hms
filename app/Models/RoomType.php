<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roomtype extends Model
{
    use HasFactory;
    protected $fillable = ['type_name', 'description', 'adult_occupancy', 'child_occupancy', 'image', 'base_occupancy', 'higher_occupancy', 'extra_bed', 'base_price', 'additional_price', 'extra_bed_price'];

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'amenity_roomtype', 'roomtype_id', 'amenity_id');
    }
}
