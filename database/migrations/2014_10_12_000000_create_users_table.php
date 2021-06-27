<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->increments('id');
            $table->string('fullname',255)->unique()->index();
            $table->string('username',255)->unique()->index();
            $table->string('email',255)->unique()->index();
            $table->text('phone')->unique()->index()->nullable();
            $table->integer('status')->default('1');
            $table->integer('approve')->default('0');
            $table->integer('gender')->default('1')->nullable();
            $table->date('dob')->default(\Carbon\Carbon::now())->nullable();
            $table->integer('role_id')->unsigned()->index();
            $table->integer('country_id')->unsigned()->index();
            $table->text('password')->nullable();
            $table->text('google_id')->nullable();
            $table->text('facebook_id')->nullable();
            $table->text('apple_id')->nullable();
            $table->string('facebook',255)->nullable();
            $table->string('website',255)->nullable();
            $table->string('youtube',255)->nullable();
            $table->string('twitter',255)->nullable();
            $table->string('instagram',255)->nullable();
            $table->integer('wp_user_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('token')->nullable();
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
        Schema::dropIfExists('users');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
