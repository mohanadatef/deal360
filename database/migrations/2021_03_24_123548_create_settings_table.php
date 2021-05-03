<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
			$table->increments('id');
			$table->string('facebook',255);
			$table->string('youtube',255);
			$table->string('twitter',255);
            $table->string('instagram',255);
            $table->string('email',255);
            $table->text('phone');
            $table->text('latitude');
            $table->text('longitude');
            $table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Schema::dropIfExists('settings');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
