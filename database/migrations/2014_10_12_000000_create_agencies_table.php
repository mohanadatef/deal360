<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->increments('id');
            $table->string('fullname',255)->unique()->index();
            $table->text('address')->index();
            $table->integer('user_id')->unsigned()->index();
            $table->text('whatsapp')->unique()->index()->nullable();
            $table->text('mobile')->unique()->index()->nullable();
            $table->text('phone')->unique()->index()->nullable();
            $table->integer('country_id')->unsigned()->index();
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
        Schema::dropIfExists('agencies');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
