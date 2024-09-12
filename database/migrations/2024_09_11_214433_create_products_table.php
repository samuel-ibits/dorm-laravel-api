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
        Schema::create('products', function (Blueprint $table) {
            $table->string('productid', 50)->primary();
            $table->string('userid', 30);
            $table->text('name');
            $table->text('price');
            $table->text('location');
            $table->text('about');
            $table->text('categories');
            $table->text('pic1');
            $table->text('pic2')->nullable();
            $table->text('pic3')->nullable();
            $table->text('pic4')->nullable();
            $table->text('vid')->nullable();
            $table->text('sold')->nullable();
            $table->text('unit');
            $table->text('status');
            $table->text('views')->nullable();
            $table->text('contact');
            $table->text('link')->nullable();
            $table->text('eta')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
