<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfiguraciongeneralappTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('configuraciongeneralapp', function(Blueprint $table)
		{
			$table->integer('Id', true);
			$table->string('color_primaro_app')->nullable();
			$table->string('color_secundario_app')->nullable();
			$table->string('¿numero menus?')->nullable();
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
		Schema::drop('configuraciongeneralapp');
	}

}
