<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriasprogramasProgramasusuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categoriasprogramas_programasusuarios', function(Blueprint $table)
		{
			$table->integer('id_categoria_programa')->nullable()->index('IdCategorias3_idx');
			$table->integer('id_programausuario')->nullable()->index('IdProgramasUsuarios_idx');
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
		Schema::drop('categoriasprogramas_programasusuarios');
	}

}
