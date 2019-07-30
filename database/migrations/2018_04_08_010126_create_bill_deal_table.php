<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillDealTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_deal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_id')->unsigned();
            $table->integer('deal_id')->unsigned();
            $table->timestamps();

            $table->foreign('bill_id')
                ->references('id')
                ->on('bills')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('deal_id')
                ->references('id')
                ->on('deals')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_deal');
    }
}
