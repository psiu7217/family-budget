<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
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
        Schema::create('user_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');
            $table->timestamps();
        });

        DB::table('user_roles')->insert(
            [
                ['title' => 'Администратор', 'slug' => 'admin'],
                ['title' => 'Пользователь', 'slug' => 'user'],
                ['title' => 'Гость', 'slug' => 'guest']
            ]
        );


        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('login')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('img')->nullable();
            $table->bigInteger('role')->unsigned()->default(3);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function ($table) {
            $table->foreign('role')->references('id')->on('user_roles');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_roles');
    }
}
