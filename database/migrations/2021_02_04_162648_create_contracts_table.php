<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('customer_id');
            $table->date('start_day');
            $table->date('end_day');
            $table->double('administrative_fee',10,2);
            $table->double('rent_amount',10,2);
            $table->double('condominium_amount',10,2);
            $table->double('iptu_amount',10,2);
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('owners');
            $table->foreign('property_id')->references('id')->on('properties');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
