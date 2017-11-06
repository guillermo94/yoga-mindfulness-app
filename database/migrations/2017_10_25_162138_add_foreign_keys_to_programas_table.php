<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProgramasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('programas', function(Blueprint $table)
		{
			$table->foreign('usuario_Id', 'UsuarioCreadorPrograma')->references('Id')->on('usuarios')->onUpdate('CASCADE')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('programas', function(Blueprint $table)
		{
			$table->dropForeign('UsuarioCreadorPrograma');
		});
	}

}
