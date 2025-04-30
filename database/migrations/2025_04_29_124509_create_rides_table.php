<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id');
            $table->string('origin');
            $table->string('destination');
            $table->dateTime('departure_time');
            $table->integer('available_seats');
            $table->decimal('price_per_seat' , 8 , 2);
            $table->string('image')->nullable();
            $table->text('notes')->nullable(); // Optional
            $table->timestamps();

            // Foreign key
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade');

            // Indexes
            $table->index('departure_time');
            $table->index('origin');
            $table->index('destination');
            $table->index('available_seats');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
