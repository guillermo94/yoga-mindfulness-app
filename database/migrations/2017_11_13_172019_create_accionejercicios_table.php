<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccionejerciciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accionejercicios', function(Blueprint $table)
		{
			$table->integer('Id', true);
			$table->string('nombre')->nullable();
			$table->integer('duracion')->nullable()->default(0);
			$table->integer('num_repeticiones')->nullable()->default(0);
			$table->string('tipo')->nullable();
			$table->string('url_file')->nullable();
			$table->integer('seccionejercicio_Id')->nullable()->default(0)->index('idSeccion_idx');
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
		Schema::drop('accionejercicios');
	}

}
