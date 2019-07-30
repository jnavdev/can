<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rut');
            $table->string('full_name');
            $table->string('address')->nullable();
            $table->string('activity')->nullable();
            $table->text('observation')->nullable();
            $table->string('phone')->nullable();
            $table->integer('payment_method_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('payment_method_id')
                ->references('id')
                ->on('payment_methods')
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
        Schema::dropIfExists('clients');
    }
}
