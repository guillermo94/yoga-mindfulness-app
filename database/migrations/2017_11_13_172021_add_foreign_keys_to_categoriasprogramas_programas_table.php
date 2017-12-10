<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCategoriasprogramasProgramasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('categoriasprogramas_programas', function(Blueprint $table)
		{
			$table->foreign('categoriasprograma_Id', 'IdCategorias3')->references('Id')->on('categoriasprogramas')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('programa_Id', 'IdProgramas')->references('Id')->on('programas')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('categoriasprogramas_programas', function(Blueprint $table)
		{
			$table->dropForeign('IdCategorias3');
			$table->dropForeign('IdProgramas');
		});
	}

}
