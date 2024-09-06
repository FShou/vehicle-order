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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('licence_plate')->unique();
            $table->enum('type',['passanger','cargo']);
            $table->enum('fuel_type', ['solar','pertalite','pertamax']);
            $table->tinyInteger('remaining_fuel_bar');
            $table->integer('distance_covered');
            $table->foreignId('vehicle_owner_id')->constrained('vehicle_owners')->cascadeOnDelete();
            $table->enum('status',['need_maintenance', 'maintenance', 'in_use','available']);
            $table->dateTime('lease_expiration_date')->nullable()->default(null);
            $table->dateTime('last_maintenance_date')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
