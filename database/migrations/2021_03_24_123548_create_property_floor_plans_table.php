<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePropertyFloorPlansTable extends Migration {

	public function up()
	{
		Schema::create('property_floor_plans', function(Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
			$table->increments('id');
            $table->integer('property_id')->unsigned()->index();
            $table->integer('size')->default('0');
            $table->integer('room')->default('0');
            $table->integer('bedroom')->default('0');
            $table->integer('bathroom')->default('0');
            $table->integer('price')->default('0');
            $table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Schema::dropIfExists('property_floor_plans');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
