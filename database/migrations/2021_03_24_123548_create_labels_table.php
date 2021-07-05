<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateLabelsTable extends Migration {

	public function up()
	{
		Schema::create('labels', function(Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
			$table->increments('id');
			$table->string('key', 255)->unique()->index();
			$table->timestamps();
		});
	}

	public function down()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Schema::dropIfExists('labels');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
