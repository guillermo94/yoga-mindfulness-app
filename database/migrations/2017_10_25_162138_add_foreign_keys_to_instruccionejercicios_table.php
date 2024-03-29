<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInstruccionejerciciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('instruccionejercicios', function(Blueprint $table)
		{
			$table->foreign('accionejercicio_Id', 'idAccion')->references('Id')->on('accionejercicios')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('instruccionejercicios', function(Blueprint $table)
		{
			$table->dropForeign('idAccion');
		});
	}

}
