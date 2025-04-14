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
        Schema::create('auberges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('address');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 11, 7)->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('website')->nullable();
            $table->integer('capacity');
            $table->decimal('price_per_night', 8, 2);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->foreignId('manager_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('region_id')->constrained()->onDelete('cascade');
            $table->foreignId('city_id')->constrained('villes')->onDelete('cascade');
            $table->timestamps();
        });

         
         Schema::create('auberge_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auberge_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        
        Schema::create('auberge_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auberge_id')->constrained()->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auberge_tag');
        Schema::dropIfExists('auberge_service');
        Schema::dropIfExists('auberges');
    }
};
