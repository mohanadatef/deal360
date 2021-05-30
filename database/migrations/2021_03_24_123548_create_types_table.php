<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTypesTable extends Migration {

	public function up()
	{
		Schema::create('types', function(Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
			$table->increments('id');
			$table->integer('status')->default('1');
            $table->integer('order')->unique();
            $table->integer('wp_type_id')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Schema::dropIfExists('types');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
