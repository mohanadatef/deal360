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
            $table->float('price')->default('0');
            $table->float('video_url')->nullable();
            $table->float('size')->default('0');
            $table->float('lot_size')->default('0');
            $table->integer('room')->default('0');
            $table->integer('bedroom')->default('0');
            $table->integer('bathroom')->default('0');
            $table->integer('garage')->default('0');
            $table->integer('area')->default('0');
            $table->text('latitude');
            $table->text('longitude');
            $table->text('virtual_tour')->nullable();
            $table->text('youtube_id')->nullable();
            $table->date('available_from')->default(\Carbon\Carbon::now())->nullable();
            $table->integer('floor_number')->default('0');
            $table->string('type_date',255)->default('year')->nullable();
            $table->integer('count_date')->default('1')->nullable();
            $table->integer('order')->unique();
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
