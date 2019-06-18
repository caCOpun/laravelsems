<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('surname');
			$table->bigInteger('identification_number')->unique();
			$table->integer('age');
			$table->string('gender');
			$table->string('birthday');
			$table->boolean('active')->default('1');
			$table->string('desc');
			$table->string('year');
			$table->string('semester');
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
		//
	}

}
