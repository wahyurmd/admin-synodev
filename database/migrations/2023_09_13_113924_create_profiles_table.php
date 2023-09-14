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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->string('title')->nullable();
            $table->string('phone')->nullable();
            $table->string('desc')->nullable();
            $table->text('address')->nullable();
            $table->string('picture')->nullable();
            $table->string('years_experience')->nullable();
            $table->string('curriculum_vitae')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
