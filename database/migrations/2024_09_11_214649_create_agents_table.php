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
        Schema::create('agents', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->text('fullname');
            $table->text('email');
            $table->text('phone');
            $table->text('ppic')->nullable();
            $table->text('idtype');
            $table->text('idurl');
            $table->text('idurl2')->nullable();
            $table->text('address');
            $table->text('status');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
