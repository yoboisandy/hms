<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'base_occupancy', 'high_occupancy', 'amenity_id', 'floor_id', 'image', 'base_price', 'high_price'];

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function amenity()
    {
        return $this->belongsToMany(Amenity::class);
    }
}
