<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHistorialusuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('historialusuarios', function(Blueprint $table)
		{
			$table->foreign('id_ejercicio', 'IdEjercicioHistorial')->references('Id')->on('ejercicios')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_ejercicio', 'IdUsuarioHistorial')->references('Id')->on('usuarios')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('historialusuarios', function(Blueprint $table)
		{
			$table->dropForeign('IdEjercicioHistorial');
			$table->dropForeign('IdUsuarioHistorial');
		});
	}

}
