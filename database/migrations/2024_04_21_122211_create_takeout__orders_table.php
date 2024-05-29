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
        Schema::create('takeout__orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('takeout_id')->constrained();
            $table->foreignId('menu_id')->constrained();
            $table->integer('quantity');
            $table->string('status')->default('cooking');
            $table->string('check_status')->default('not yet');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('takeout__orders');
    }
};
