<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFieldsToHcCarriersCollectAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_carriers_collect_addresses', function (Blueprint $table) {
            $table->string('city')->nullable();
            $table->string('second_name')->nullable();
            $table->string('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_carriers_collect_addresses', function (Blueprint $table) {
            $table->dropColumn('city', 'second_name', 'comment');
        });
    }
}
