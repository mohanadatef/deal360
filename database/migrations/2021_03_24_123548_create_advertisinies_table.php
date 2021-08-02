<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAdvertisiniesTable extends Migration {

	public function up()
	{
		Schema::create('advertisinies', function(Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
			$table->increments('id');
            $table->text('url');
            $table->integer('status')->default('0');
            $table->integer('approve')->default('0');
            $table->integer('user_id')->unsigned()->index();
            
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Schema::dropIfExists('advertisinies');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
