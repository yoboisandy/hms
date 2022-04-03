<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = ['firstname', 'lastname', 'email', 'phone', 'address', 'citizenship_number', 'password', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function room()
    {
        return $this->belongsToMany(Room::class);
    }
    public function food()
    {
        return $this->belongsToMany(Food::class);
    }
}
