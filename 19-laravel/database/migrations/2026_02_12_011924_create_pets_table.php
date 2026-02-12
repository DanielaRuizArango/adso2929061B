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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->default('no-image.png');
            $table->string('kind');
            $table->double('weight');
            $table->integer('age');
            $table->string('breed');
            $table->string('location');
            $table->text('description');
            $table->boolean('active')->default(1);
            $table->boolean('adopted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
