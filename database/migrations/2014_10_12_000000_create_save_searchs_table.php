<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSaveSearchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('save_searchs', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('country_id')->unsigned()->index();
            $table->integer('city_id')->unsigned()->index();
            $table->integer('rejoin_id')->unsigned()->index();
            $table->integer('type_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->integer('high_light_id')->unsigned()->index();
            $table->string('title',255)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('save_searchs');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
