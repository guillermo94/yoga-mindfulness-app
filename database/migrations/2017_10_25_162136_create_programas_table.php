<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProgramasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('programas', function(Blueprint $table)
		{
			$table->integer('Id', true);
			$table->integer('usuario_Id')->nullable()->index('UsuarioCreadorPrograma_idx');
			$table->string('nombre')->nullable();
			$table->string('completado')->nullable();
			$table->string('dificultad')->nullable();
			$table->integer('num_ejercicios');
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
		Schema::drop('programas');
	}

}
