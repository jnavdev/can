<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillQuotationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_quotation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_id')->unsigned();
            $table->integer('quotation_id')->unsigned();
            $table->timestamps();

            $table->foreign('bill_id')
                ->references('id')
                ->on('bills')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('quotation_id')
                ->references('id')
                ->on('quotations')
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
        Schema::dropIfExists('bill_quotation');
    }
}
