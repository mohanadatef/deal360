<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCallUsTable extends Migration {

	public function up()
	{
		Schema::create('call_us', function(Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
			$table->increments('id');
			$table->string('title',255);
            $table->string('email',255);
            $table->text('phone');
            $table->text('description');
            $table->integer('status')->default('0');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Schema::dropIfExists('call_us');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
