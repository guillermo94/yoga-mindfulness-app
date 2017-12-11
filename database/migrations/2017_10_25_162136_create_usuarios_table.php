<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios', function(Blueprint $table)
		{
			$table->integer('Id', true);
			$table->string('email')->unique('email_unique');
			$table->string('password');
			$table->string('nombre')->nullable();
			$table->string('apellidos')->nullable();
			$table->string('img_perfil')->nullable();
			$table->string('descripcion')->nullable();
			$table->string('sexo')->nullable();
			$table->integer('edad')->nullable();
			$table->string('rol')->nullable();
			$table->integer('id_program_act')->nullable()->default(0)->index('id_program_act');
			$table->integer('progreso_prog_act')->nullable();
			$table->integer('experiencia_total')->nullable();
			$table->boolean('notif_activas')->nullable()->default(0);
			$table->string('hora_notif', 45)->nullable()->default('12:00');
			$table->integer('num_dias_clase')->nullable();
			$table->string('modo_ejercicio')->nullable()->default('0');
			$table->string('foto_perfil')->nullable();
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
		Schema::drop('usuarios');
	}

}
