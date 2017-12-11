<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDudasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dudas', function(Blueprint $table)
		{
			$table->integer('Id', true);
			$table->integer('usuario_Id')->index('Id_autor_duda_idx');
			$table->text('titulo', 65535)->nullable();
			$table->text('contenido', 65535)->nullable();
			$table->integer('tipo_usuario')->nullable();
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
		Schema::drop('dudas');
	}

}
