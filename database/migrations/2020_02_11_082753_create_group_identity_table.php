<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupIdentityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_identity', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group_name', 64)->nullable()->comment("角色名称");
            $table->tinyInteger('type')->default(1)->comment("级别");
            $table->text('privileges')->nullable()->comment("权限列表");
            $table->string('description', 64)->nullable()->comment("简单描述");
            $table->tinyInteger('creat_id')->nullable()->default(0)->comment("创建者id");
            $table->tinyInteger('status')->default(1)->comment('状态');
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
        Schema::dropIfExists('group_identity');
    }
}
