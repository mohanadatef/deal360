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
            $table->integer('rejoin_id')->unsigned()->index();
            $table->integer('status_id')->unsigned()->index();
            $table->integer('type_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->integer('currency_id')->unsigned()->index();
            $table->integer('high_light_id')->unsigned()->index();
            $table->double('price')->default('0');
            $table->float('video_url')->nullable();
            $table->float('size')->default('0');
            $table->float('lot_size')->default('0');
            $table->float('room')->default('0');
            $table->float('bedroom')->default('0');
            $table->double('bathroom')->default('0');
            $table->integer('garage')->default('0');
            $table->float('area')->default('0');
            $table->float('latitude');
            $table->float('longitude');
            $table->text('virtual_tour')->nullable();
            $table->text('youtube_id')->nullable();
            $table->dateTime('available_from')->default(\Carbon\Carbon::now())->nullable();
            $table->float('floor_number')->default('0');
            $table->string('type_date',255)->default('year')->nullable();
            $table->float('count_date')->default('1')->nullable();
            $table->integer('order')->unique();
            $table->integer('count_view')->default('0');
            $table->double('avg_rating')->default('0');
            $table->integer('wp_property_id')->nullable();
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
