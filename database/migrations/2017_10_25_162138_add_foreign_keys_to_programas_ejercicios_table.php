<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProgramasEjerciciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('programas_ejercicios', function(Blueprint $table)
		{
			$table->foreign('ejercicio_Id', 'IdEjercicioProgramaUsuario')->references('Id')->on('ejercicios')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('programa_Id', 'IdProgramaUsuarioEjericicios')->references('Id')->on('programas')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('programas_ejercicios', function(Blueprint $table)
		{
			$table->dropForeign('IdEjercicioProgramaUsuario');
			$table->dropForeign('IdProgramaUsuarioEjericicios');
		});
	}

}
