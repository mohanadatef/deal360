<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePropertyPhotographicInformationsTable extends Migration {

	public function up()
	{
		Schema::create('property_photographic_informations', function(Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
			$table->increments('id');
            $table->integer('property_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->text('contact_number');
            $table->text('contact_name');
            $table->date('shooting_date')->default(\Carbon\Carbon::now());
            $table->time('shooting_time')->default(\Carbon\Carbon::now());
            $table->text('shooting_address');
            $table->text('notes');
            $table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Schema::dropIfExists('property_photographic_informations');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}