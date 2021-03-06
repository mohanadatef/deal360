<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePackagesTable extends Migration {

	public function up()
	{
		Schema::create('packages', function(Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
			$table->increments('id');
			$table->integer('count_listing')->default('0');
			$table->integer('image_included')->default('0');
			$table->integer('count_featured')->default('0');
            $table->float('price')->default('0');
            $table->string('type_date',255)->default('year');
            $table->integer('currency_id')->unsigned()->index();
            $table->integer('count_date')->default('1');
            $table->integer('status')->default('1');
            $table->integer('order')->unique();
            $table->integer('wp_package_id')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Schema::dropIfExists('packages');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
