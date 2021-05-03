<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePropertiesTable extends Migration {

	public function up()
	{
		Schema::create('properties', function(Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
			$table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('country_id')->unsigned()->index();
            $table->integer('city_id')->unsigned()->index();
            $table->integer('area_id')->unsigned()->index();
            $table->integer('status_id')->unsigned()->index();
            $table->integer('type_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->integer('high_light_id')->unsigned()->index();
            $table->float('price')->default('0');
            $table->float('size')->default('0');
            $table->integer('room')->default('0');
            $table->integer('bedroom')->default('0');
            $table->integer('bathroom')->default('0');
            $table->text('latitude');
            $table->text('longitude');
            $table->integer('count_view')->default('0');
            $table->integer('feature')->default('0');
            $table->integer('order')->unique();
            $table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Schema::dropIfExists('properties');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
