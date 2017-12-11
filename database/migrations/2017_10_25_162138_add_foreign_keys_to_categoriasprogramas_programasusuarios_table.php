<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCategoriasprogramasProgramasusuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('categoriasprogramas_programasusuarios', function(Blueprint $table)
		{
			$table->foreign('id_categoria_programa', 'IdCategorias3')->references('Id')->on('categoriasprogramas')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_programausuario', 'IdProgramasUsuarios')->references('Id')->on('programas')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('categoriasprogramas_programasusuarios', function(Blueprint $table)
		{
			$table->dropForeign('IdCategorias3');
			$table->dropForeign('IdProgramasUsuarios');
		});
	}

}
