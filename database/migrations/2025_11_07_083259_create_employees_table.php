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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            // --- ESSENTIAL AUTH FIELDS ---
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            // -----------------------------

            // --- EMPLOYEE-SPECIFIC FIELDS ---
            $table->string('first_name');
             $table->string('middle_name')->nullable();
            $table->string('last_name');
             $table->string('phone');
            $table->string('employee_id')->unique();
            $table->foreignId('address_id')->constrained()->onDelete('cascade');
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
