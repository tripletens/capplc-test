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
        // for Date, Employee name, Department, Task details, and Hours worked.
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('employee_name')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->text('task_details')->nullable();
            $table->integer('hours_worked')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
