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
        Schema::create('zipcodes', function (Blueprint $table) {
            $table->id();
            $table->string('county');
            $table->string('city');
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('zipcode')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zipcodes');
    }
};
