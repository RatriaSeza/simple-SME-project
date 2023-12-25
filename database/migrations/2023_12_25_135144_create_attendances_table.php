<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');

            $table->date('attendance_date');
            $table->string('day');
            $table->time('time_in');
            $table->time('time_out');
            $table->time('break_time_start');
            $table->time('break_time_end');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
