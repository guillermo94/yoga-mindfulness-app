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
			$table->foreign('id_categoria_ejercicio', 'IdCategoria')->references('Id')->on('categoriasejercicios')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_ejercicio', 'IdEjercicio')->references('Id')->on('ejercicios')->onUpdate('CASCADE')->onDelete('CASCADE');
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
