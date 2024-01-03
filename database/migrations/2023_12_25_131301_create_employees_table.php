<?php

use App\Models\Employee;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 100)->unique();
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('nick_name', 255)->nullable();
            $table->date('birth_date');
            $table->string('position', 255); // responsibility or functionality
            $table->enum('gender', Employee::GENDER);
            $table->string('education', 100);
            $table->string('id_number');
            $table->enum('marital_status', Employee::MARITAL_STATUS);
            $table->date('join_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
