<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVentanaintroduccionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ventanaintroduccion', function(Blueprint $table)
		{
			$table->integer('Id', true);
			$table->integer('posicion')->nullable();
			$table->string('contenido')->nullable();
			$table->integer('id_intro')->nullable()->default(0)->index('id_intro');
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
		Schema::drop('ventanaintroduccion');
	}

}
