<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRespuestasDudasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('respuestas_dudas', function(Blueprint $table)
		{
			$table->integer('Id', true);
			$table->integer('duda_Id')->index('Id_duda_idx');
			$table->integer('usuario_Id')->index('Id_autor_respuesta_idx');
			$table->text('contenido', 65535)->nullable();
			$table->integer('leido')->nullable()->default(0);
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
		Schema::drop('respuestas_dudas');
	}

}
