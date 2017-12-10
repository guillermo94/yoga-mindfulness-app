<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriasejerciciosEjerciciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categoriasejercicios_ejercicios', function(Blueprint $table)
		{
			$table->integer('categoriasejercicio_Id')->nullable()->index('IdCategoria_idx');
			$table->integer('ejercicio_Id')->nullable()->index('IdEjercicio_idx');
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
		Schema::drop('categoriasejercicios_ejercicios');
	}

}
