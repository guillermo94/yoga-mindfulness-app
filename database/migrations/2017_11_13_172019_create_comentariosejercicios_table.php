<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComentariosejerciciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comentariosejercicios', function(Blueprint $table)
		{
			$table->integer('Id', true);
			$table->integer('ejercicio_Id')->nullable()->default(0)->index('id_ejercicio');
			$table->integer('usuario_Id')->index('IdAutorComentario_idx');
			$table->dateTime('fecha')->nullable();
			$table->text('titulo', 65535)->nullable();
			$table->text('contendio', 65535)->nullable();
			$table->float('puntuacion', 10, 0)->nullable()->default(0);
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
		Schema::drop('comentariosejercicios');
	}

}
