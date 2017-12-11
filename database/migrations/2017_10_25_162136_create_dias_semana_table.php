<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiasSemanaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dias_semana', function(Blueprint $table)
		{
			$table->integer('Id', true);
			$table->integer('lunes')->nullable()->default(0);
			$table->integer('martes')->nullable()->default(0);
			$table->integer('miercoles')->nullable()->default(0);
			$table->integer('jueves')->nullable()->default(0);
			$table->integer('viernes')->nullable()->default(0);
			$table->integer('sabado')->nullable()->default(0);
			$table->integer('domingo')->nullable()->default(0);
			$table->integer('usuario_Id')->index('Id_usuario_idx');
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
		Schema::drop('dias_semana');
	}

}
