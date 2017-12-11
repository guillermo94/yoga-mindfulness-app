<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProgramasdefaultEjerciciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('programasdefault_ejercicios', function(Blueprint $table)
		{
			$table->foreign('ejercicio_Id', 'IdEjercicioIntermedia')->references('Id')->on('ejercicios')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('programadefault_Id', 'IdProgramaDefaultIntermedia')->references('Id')->on('programasdefault')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('programasdefault_ejercicios', function(Blueprint $table)
		{
			$table->dropForeign('IdEjercicioIntermedia');
			$table->dropForeign('IdProgramaDefaultIntermedia');
		});
	}

}
