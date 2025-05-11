<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Rename the existing table
        Schema::rename('reservations', 'reservations_old');

        // Create new table with updated enum values
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ride_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('seats')->default(1);
            $table->enum('status', ['pending', 'confirmed', 'rejected', 'canceled', 'completed'])->default('pending');
            $table->timestamps();
        });

        // Copy data from old table to new one
        DB::table('reservations')->insert(
            DB::table('reservations_old')->select('*')->get()->toArray()
        );

        // Drop the old table
        Schema::drop('reservations_old');
    }

    public function down(): void
    {
        // Optional: reverse the change (if needed)
        Schema::dropIfExists('reservations');
    }
};
