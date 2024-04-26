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
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('order_status')->default(4)->change();
            $table->integer('status')->default(2)->change();
            $table->integer('check_status')->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_status')->default('new')->change();
            $table->string('status')->default('cooking')->change();
            $table->string('check_status')->default('not yet')->change();
        });
    }
};
