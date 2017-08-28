<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFreeFromPriceToHcCarriersDeliveryOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_carriers_delivery_options', function (Blueprint $table) {
            $table->float('free_from_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_carriers_delivery_options', function (Blueprint $table) {
            $table->dropColumn('free_from_price');
        });
    }
}
