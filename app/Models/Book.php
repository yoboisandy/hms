<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'user_id', 'status', 'start_date', 'end_date', 'room_req', 'roomtype_id'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function roomtype()
    {
        return $this->belongsToMany(Roomtype::class);
    }
}
