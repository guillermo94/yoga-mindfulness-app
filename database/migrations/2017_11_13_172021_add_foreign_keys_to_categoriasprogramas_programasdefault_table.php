<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCategoriasprogramasProgramasdefaultTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('categoriasprogramas_programasdefault', function(Blueprint $table)
		{
			$table->foreign('id_categoria_programa', 'IdCategoria2')->references('Id')->on('categoriasprogramas')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_programadefault', 'IdProgramaDefault')->references('Id')->on('programasdefault')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('categoriasprogramas_programasdefault', function(Blueprint $table)
		{
			$table->dropForeign('IdCategoria2');
			$table->dropForeign('IdProgramaDefault');
		});
	}

}
