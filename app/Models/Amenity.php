<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'icon', 'description'];

    public function halls()
    {
        return $this->belongsToMany(Hall::class);
    }
    public function room_types()
    {
        return $this->belongsToMany(RoomType::class, 'amenity_roomtype', 'amenity_id', 'roomtype_id');
    }
}
