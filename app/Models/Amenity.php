<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'icon', 'description'];

    public function hall()
    {
        return $this->hasMany(Hall::class);
    }
}
