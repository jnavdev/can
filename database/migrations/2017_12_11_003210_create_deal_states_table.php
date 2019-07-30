<?php

use App\DealState;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });

        DealState::create([
            'name' => 'Abierto',
            'description' => 'Se crea la oportunidad de negocio'
        ]);

        DealState::create([
            'name' => 'Proceso',
            'description' => 'Se abre foro de discusión (Online Meeting)'
        ]);

        DealState::create([
            'name' => 'Cerrado',
            'description' => 'Cliente rechaza opción de compra (obligatorio para cambiar este estado es un PDF, que sea cotización o impresión de correo que manifieste el rechazo Y el número de cotización; opcional comentarios)'
        ]);

        DealState::create([
            'name' => 'Finalizado',
            'description' => 'Compra efectuada por cliente (obligatorio adjuntar pdf con factura y campo para agregar el número de factura; opcional Comentarios)'
        ]);

        DealState::create([
            'name' => 'Reapertura',
            'description' => 'Negocio cerrado y facturado se retoma ya sea porque cliente desea retomar el negocio cerrado o por post venta (Garantia) de negocio facturado'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deal_states');
    }
}
