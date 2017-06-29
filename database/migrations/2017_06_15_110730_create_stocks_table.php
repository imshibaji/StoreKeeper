<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->integer('unit');
            $table->float('unitPurchPrice', 8, 2);
            $table->float('totalPurchAmount', 8, 2);
            $table->float('unitSalePrice', 8, 2);
            $table->float('saleTax', 8, 2);
            $table->float('saleDisount', 8, 2);
            $table->float('unitSaleAmt', 8, 2);
            $table->float('totalSaleAmount', 8, 2);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
