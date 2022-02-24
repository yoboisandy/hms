<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'floor_number', 'description'];

    public function hall()
    {
        return $this->hasMany(Hall::class);
    }

    public function room()
    {
        return $this->hasMany(Room::class);
    }
}
