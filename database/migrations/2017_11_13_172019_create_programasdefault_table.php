<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProgramasdefaultTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('programasdefault', function(Blueprint $table)
		{
			$table->integer('Id', true);
			$table->string('nombre')->nullable();
			$table->string('dificultad')->nullable();
			$table->string('categoria')->nullable();
			$table->integer('num_ejercicios');
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
		Schema::drop('programasdefault');
	}

}
