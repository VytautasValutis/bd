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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->string('story' , 5000);
            $table->decimal('need_money' , 9, 2);
            $table->string('photo', 200)->nullable()->default(null);
            $table->unsignedTinyInteger('approved');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
