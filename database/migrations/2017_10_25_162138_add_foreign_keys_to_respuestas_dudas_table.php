<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRespuestasDudasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('respuestas_dudas', function(Blueprint $table)
		{
			$table->foreign('usuario_Id', 'Id_autor_respuesta')->references('Id')->on('usuarios')->onUpdate('CASCADE')->onDelete('NO ACTION');
			$table->foreign('duda_Id', 'Id_duda')->references('Id')->on('dudas')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('respuestas_dudas', function(Blueprint $table)
		{
			$table->dropForeign('Id_autor_respuesta');
			$table->dropForeign('Id_duda');
		});
	}

}
