<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToComentariosejerciciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('comentariosejercicios', function(Blueprint $table)
		{
			$table->foreign('usuario_Id', 'IdAutorComentario')->references('Id')->on('usuarios')->onUpdate('CASCADE')->onDelete('NO ACTION');
			$table->foreign('ejercicio_Id', 'IdEjercicio2')->references('Id')->on('ejercicios')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comentariosejercicios', function(Blueprint $table)
		{
			$table->dropForeign('IdAutorComentario');
			$table->dropForeign('IdEjercicio2');
		});
	}

}
