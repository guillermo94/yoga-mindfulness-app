<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAccionejerciciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('accionejercicios', function(Blueprint $table)
		{
			$table->foreign('seccionejercicio_Id', 'idSeccion')->references('Id')->on('seccionejercicios')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('accionejercicios', function(Blueprint $table)
		{
			$table->dropForeign('idSeccion');
		});
	}

}
