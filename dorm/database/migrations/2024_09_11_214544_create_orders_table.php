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
        Schema::create('orders', function (Blueprint $table) {
            $table->string('orderid', 50)->primary();
            $table->string('productid', 50);
            $table->text('productname');
            $table->text('productpic');
            $table->string('userid', 50);
            $table->text('buyerid');
            $table->text('buyerpic');
            $table->text('buyername');
            $table->text('buyeraddress');
            $table->text('price');
            $table->text('status');
            $table->text('date');
            $table->text('year');
            $table->text('eta');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
