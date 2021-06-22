<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateWorkTimesTable extends Migration {

	public function up()
	{
		Schema::create('work_times', function(Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
			$table->increments('id');
			$table->morphs('category');
			$table->text('day')->index();
			$table->Time('started_at')->index()->default(\Carbon\Carbon::createFromTimeString('09:00:00'));
			$table->Time('ended_at')->index()->default(\Carbon\Carbon::createFromTimeString('17:00:00'));
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Schema::dropIfExists('work_times');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
