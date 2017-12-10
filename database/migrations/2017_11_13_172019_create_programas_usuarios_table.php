<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProgramasUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('programas_usuarios', function(Blueprint $table)
		{
			$table->integer('programa_Id')->nullable()->default(0)->index('id_programa_usuario');
			$table->integer('usuario_Id')->index('IdUsuarioPrograma_idx');
			$table->integer('progreso')->nullable()->default(0);
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
		Schema::drop('programas_usuarios');
	}

}
