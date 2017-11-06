<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProgramasdefaultEjerciciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('programasdefault_ejercicios', function(Blueprint $table)
		{
			$table->integer('programadefault_Id')->nullable()->index('IdProgramaIntermedia_idx');
			$table->integer('ejercicio_Id')->nullable()->index('IdEjercicioIntermedia_idx');
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
		Schema::drop('programasdefault_ejercicios');
	}

}
