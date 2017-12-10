<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiasClaseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dias_clase', function(Blueprint $table)
		{
			$table->integer('Id', true);
			$table->integer('usuario_Id')->index('IdUsuarioNotificacion_idx');
			$table->string('nombre')->nullable();
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
		Schema::drop('dias_clase');
	}

}
