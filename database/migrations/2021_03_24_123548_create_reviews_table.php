<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateReviewsTable extends Migration {

	public function up()
	{
		Schema::create('reviews', function(Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
			$table->increments('id');
            $table->morphs('category');
			$table->string('title',255);
            $table->text('description');
            $table->integer('status')->default('0');
            $table->integer('rating')->default('0');
            $table->integer('order')->default('0');
            $table->integer('user_id')->unsigned()->index();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Schema::dropIfExists('reviews');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
