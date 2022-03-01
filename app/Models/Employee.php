<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['firstname', 'lastname', 'email', 'password', 'dob', 'phone', 'department_id', 'designation', 'address', 'image', 'citizenship_number', 'pan_number', 'joining_date', 'salary', 'shift_id', 'role_id'];


    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
