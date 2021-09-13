<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('nike_name', 64)->nullable()->comment("登陆账户的名称  name 是登陆账户");
            $table->string('password');

            $table->string('google', 64);// 谷歌验证码
            $table->string('type');
            $table->integer('groups_id')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('creat_id')->nullable()->comment("创建者id");

            $table->text('privileges')->nullable()->comment("个人单独权限列表");
            $table->string('session_id',255)->default(''); //sessionid
            $table->tinyInteger('status')->default(1);

            $table->rememberToken();
            $table->index('name');
            $table->timestamps();
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
    }
}
