<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProgramasEjerciciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('programas_ejercicios', function(Blueprint $table)
		{
			$table->integer('programa_Id')->nullable()->index('IdProgramaUsuarioEjericicios_idx');
			$table->integer('ejercicio_Id')->nullable()->index('IdEjercicioProgramaUsuario_idx');
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
		Schema::drop('programas_ejercicios');
	}

}
