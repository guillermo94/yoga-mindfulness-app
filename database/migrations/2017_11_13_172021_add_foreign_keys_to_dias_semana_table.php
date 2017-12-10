<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDiasSemanaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('dias_semana', function(Blueprint $table)
		{
			$table->foreign('usuario_Id', 'Id_usuario_dias')->references('Id')->on('usuarios')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('dias_semana', function(Blueprint $table)
		{
			$table->dropForeign('Id_usuario_dias');
		});
	}

}
