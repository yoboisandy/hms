<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('password');
            $table->date('dob');
            $table->string('phone');
            $table->foreignId('department_id')->constrained();
            $table->foreignId('role_id')->constrained();
            $table->string('designation');
            $table->string('address');
            $table->string('image');
            $table->string('citizenship_number');
            $table->string('pan_number');
            $table->date('joining_date');
            $table->string('salary');
            $table->foreignId('shift_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
