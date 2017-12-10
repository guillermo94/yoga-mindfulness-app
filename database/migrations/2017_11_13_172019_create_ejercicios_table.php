<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEjerciciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ejercicios', function(Blueprint $table)
		{
			$table->integer('Id', true);
			$table->string('nombre')->nullable();
			$table->string('duracion')->nullable();
			$table->string('introduccion')->nullable();
			$table->string('miniatura', 45)->nullable();
			$table->float('puntuacion_media', 10, 0)->nullable()->default(0);
			$table->integer('num_votos')->nullable()->default(0);
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
		Schema::drop('ejercicios');
	}

}
