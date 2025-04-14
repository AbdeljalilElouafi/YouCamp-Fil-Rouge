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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auberge_id')->constrained()->onDelete('cascade');
            $table->string('type'); // 'Standard', 'Deluxe', 'Suite'
            $table->text('description')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('max_occupancy')->default(2);
            $table->decimal('price_per_night', 8, 2);
            $table->json('amenities')->nullable(); // ['wifi', 'tv', 'ac']
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
