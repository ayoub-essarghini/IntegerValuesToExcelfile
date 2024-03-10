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
        Schema::create('combindatas', function (Blueprint $table) {
            $table->id();
            $table->integer('a');
            $table->double('b');
            $table->double('res');
            $table->double('x');
            $table->double('fres');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combindatas');
    }
};
