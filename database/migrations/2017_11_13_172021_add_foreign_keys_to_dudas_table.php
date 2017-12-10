<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDudasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('dudas', function(Blueprint $table)
		{
			$table->foreign('usuario_Id', 'Id_autor_duda')->references('Id')->on('usuarios')->onUpdate('CASCADE')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('dudas', function(Blueprint $table)
		{
			$table->dropForeign('Id_autor_duda');
		});
	}

}
