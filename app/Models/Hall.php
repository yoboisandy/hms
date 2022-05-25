<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'occupancy',
        'amenity_id',
        'floor_id',
        'image',
        'price',
    ];

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }
}
