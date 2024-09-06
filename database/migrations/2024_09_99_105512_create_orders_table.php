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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->noActionOnDelete();
            $table->foreignId('vehicle_id')->constrained('vehicles')->noActionOnDelete();
            $table->foreignId('driver_id')->constrained('drivers')->noActionOnDelete();
            $table->string('purpose');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dateTime('taken_date')->nullable()->default(null);
            $table->dateTime('return_date')->nullable()->default(null);
            $table->enum('status',['waiting','rejected','approved','done','delivered'])->default('waiting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
