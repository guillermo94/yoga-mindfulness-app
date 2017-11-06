<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriasprogramasProgramasdefaultTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categoriasprogramas_programasdefault', function(Blueprint $table)
		{
			$table->integer('id_categoria_programa')->nullable()->index('IdProgramaDefault_idx');
			$table->integer('id_programadefault')->nullable()->index('IdProgramaDefault_idx1');
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
		Schema::drop('categoriasprogramas_programasdefault');
	}

}
