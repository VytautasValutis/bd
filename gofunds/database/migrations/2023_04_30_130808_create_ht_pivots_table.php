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
        Schema::create('ht_pivots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('histories__id')->references('_id')->on('histories')->onDelete('cascade');
            $table->unsignedBigInteger('hts__id')->references('_id')->on('hts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ht_pivots');
    }
};
