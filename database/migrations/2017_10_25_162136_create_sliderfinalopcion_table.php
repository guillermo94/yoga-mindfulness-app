<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSliderfinalopcionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sliderfinalopcion', function(Blueprint $table)
		{
			$table->integer('Id', true);
			$table->string('contenido')->nullable();
			$table->integer('ejercicio_Id')->nullable()->default(0)->index('id_ejercicio');
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
		Schema::drop('sliderfinalopcion');
	}

}
