<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProgramasUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('programas_usuarios', function(Blueprint $table)
		{
			$table->foreign('programa_Id', 'IdProgramasUsuario')->references('Id')->on('programas')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('usuario_Id', 'IdUsuarioPrograma')->references('Id')->on('usuarios')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('programas_usuarios', function(Blueprint $table)
		{
			$table->dropForeign('IdProgramasUsuario');
			$table->dropForeign('IdUsuarioPrograma');
		});
	}

}
