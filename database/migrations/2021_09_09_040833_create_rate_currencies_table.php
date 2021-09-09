<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_currencies', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('country_currency_id')->unsigned();
            $table->foreign('country_currency_id')->references('id')->on('country_currencies')->onDelete('cascade');

            $table->float('rate')->nullable();

            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();

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
        Schema::table('rate_currencies', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['country_currency_id']);
            
        });
        Schema::dropIfExists('rate_currencies');
    }
}
