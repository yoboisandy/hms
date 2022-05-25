<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['room_no', 'floor_id','roomtype_id'];

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function roomtype()
    {
        return $this->belongsTo(Roomtype::class);
    }

    public function customer()
    {
        return $this->belongsToMany(Customer::class);
    }

    // public function book()
    // {
    //     return $this->belongsTo(Book::class);
    // }
}
