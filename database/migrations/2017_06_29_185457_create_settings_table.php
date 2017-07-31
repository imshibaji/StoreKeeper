<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('business_name');
            $table->string('business_address');
            $table->string('business_phone_no');
            $table->string('gst_no');
            $table->float('sales_profit', 3, 2);
            $table->float('discount', 3, 2);
            $table->float('cgst', 3, 2);
            $table->float('sgst', 3, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
