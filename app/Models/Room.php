<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['room_no', 'floor_id', 'capacity', 'price', 'description', 'roomtype_id'];

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function roomtype()
    {
        return $this->belongsTo(Roomtype::class);
    }
}
