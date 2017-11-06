<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSliderfinalopcionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sliderfinalopcion', function(Blueprint $table)
		{
			$table->foreign('ejercicio_Id', 'IdEjercicioSlider')->references('Id')->on('ejercicios')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sliderfinalopcion', function(Blueprint $table)
		{
			$table->dropForeign('IdEjercicioSlider');
		});
	}

}
