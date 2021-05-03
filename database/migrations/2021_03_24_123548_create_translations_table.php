<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('translations', function(Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
			$table->increments('id');
			$table->morphs('category');
			$table->text('key');
			$table->text('value');
			$table->integer('language_id')->unsigned()->index();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Schema::dropIfExists('translations');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
