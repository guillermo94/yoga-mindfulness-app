<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHistorialusuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('historialusuarios', function(Blueprint $table)
		{
			$table->integer('Id', true);
			$table->integer('id_ejercicio')->index('IdEjercicioHistorial_idx');
			$table->integer('usuario_Id');
			$table->dateTime('fecha')->nullable();
			$table->integer('tiempo')->nullable();
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
		Schema::drop('historialusuarios');
	}

}
