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
        Schema::table('takeout__checkouts', function (Blueprint $table) {
            $table->integer('check_status')->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('takeout__checkouts', function (Blueprint $table) {
            $table->string('check_status')->default('not yet')->change();
        });
    }
};
