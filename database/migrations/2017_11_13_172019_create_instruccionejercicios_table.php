<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstruccionejerciciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('instruccionejercicios', function(Blueprint $table)
		{
			$table->integer('Id', true);
			$table->string('contenido', 1000)->nullable();
			$table->integer('porcetaje_tiempo')->nullable()->default(0);
			$table->string('audio')->nullable()->default('0');
			$table->integer('accionejercicio_Id')->nullable()->default(0)->index('id_accion');
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
		Schema::drop('instruccionejercicios');
	}

}
