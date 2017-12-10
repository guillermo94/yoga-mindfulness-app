<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCategoriasejerciciosEjerciciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('categoriasejercicios_ejercicios', function(Blueprint $table)
		{
			$table->foreign('categoriasejercicio_Id', 'IdCategoria')->references('Id')->on('categoriasejercicios')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('ejercicio_Id', 'IdEjercicio')->references('Id')->on('ejercicios')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('categoriasejercicios_ejercicios', function(Blueprint $table)
		{
			$table->dropForeign('IdCategoria');
			$table->dropForeign('IdEjercicio');
		});
	}

}
