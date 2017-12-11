<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeccionejerciciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seccionejercicios', function(Blueprint $table)
		{
			$table->integer('Id', true);
			$table->string('nombre')->nullable();
			$table->integer('duracion')->nullable()->default(0);
			$table->timestamps();
			$table->integer('ejercicio_Id')->nullable()->default(0)->index('id_Ejercicio_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('seccionejercicios');
	}

}
