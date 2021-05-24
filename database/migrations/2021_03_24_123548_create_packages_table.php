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
			$table->integer('count_listing');
            $table->string('type_date',255)->default('year');
            $table->integer('count_date')->default('1');
            $table->integer('status')->default('1');
            $table->integer('order')->unique();
            $table->integer('wp_id')->nullable();
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
