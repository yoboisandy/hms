<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];



    public function department()
    {
        return $this->belongsToMany(Department::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
