<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['room_id', 'user_id', 'status', 'start_date', 'end_date', 'roomtype_id', 'status', 'price',];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function roomtype()
    {
        return $this->belongsTo(Roomtype::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
