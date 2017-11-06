<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSeccionejerciciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('seccionejercicios', function(Blueprint $table)
		{
			$table->foreign('ejercicio_Id', 'id_Ejercicio')->references('Id')->on('ejercicios')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('seccionejercicios', function(Blueprint $table)
		{
			$table->dropForeign('id_Ejercicio');
		});
	}

}
