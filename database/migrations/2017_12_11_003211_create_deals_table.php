<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('creator_id')->unsigned();
            $table->integer('deal_state_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('creator_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('deal_state_id')
                ->references('id')
                ->on('deal_states')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
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
        Schema::dropIfExists('deals');
    }
}
