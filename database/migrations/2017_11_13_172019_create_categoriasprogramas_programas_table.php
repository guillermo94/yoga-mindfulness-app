<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriasprogramasProgramasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categoriasprogramas_programas', function(Blueprint $table)
		{
			$table->integer('categoriasprograma_Id')->nullable()->index('IdCategorias3_idx');
			$table->integer('programa_Id')->nullable()->index('IdProgramasUsuarios_idx');
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
		Schema::drop('categoriasprogramas_programas');
	}

}
