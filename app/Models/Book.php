<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'user_id', 'status'];

    public function room()
    {
        return $this->hasMany(Room::class);
    }
}
