<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identifier')->unique();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedBigInteger('file_id')->nullable()->index();
            $table->string('buyer_email');
            $table->decimal('sale_price',6,2);
            $table->decimal('sale_commission',6,2);
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');//ako nekogas uzero se izbrisi da klavame set null za uste da si go pamti kupenio fajl
            $table->foreign('file_id')->references('id')->on('files')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
