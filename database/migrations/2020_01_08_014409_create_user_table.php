<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 用户表
         */
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('fee')->comment('用户线下余额')->default(0);
            $table->string('name')->comment('用户姓名');
            $table->string('password')->comment('密码')->nullable();
            $table->string('phone')->comment('用户手机号')->unique()->nullable();
            $table->unsignedBigInteger('card')->comment('用户身份证号')->nullable();
            $table->unsignedBigInteger('carte_card')->comment('用户社保卡')->nullable();
            $table->unsignedBigInteger('medical_card')->comment('用户就诊卡')->nullable();
            $table->unsignedBigInteger('hospital_id')->comment('用户住院号id')->nullable();
            $table->unsignedBigInteger('register_id')->comment('登记号')->nullable();
            $table->string('image')->comment('用户头像')->nullable();
            $table->string('register_code',6)->comment('注册使用的code')->nullable();
            $table->string('login_code',6)->comment('登录使用的code')->nullable();
            $table->boolean('is_register')->comment('是否已经通过验证码验证成功注册')->default(false);
            $table->timestamp('register_code_time')->comment('注册码发送的时间 用于查看注册码是否失效')->nullable();
            $table->timestamp('login_code_time')->comment('登录码发送的时间 用于查看注册码是否失效')->nullable();
            $table->timestamp('hospitalization_date')->comment('住院时间')->nullable();
            $table->timestamp('unhospitalization_date')->comment('出院时间')->nullable();
            $table->integer('status')->comment('状态 1入院 2出院 3退院')->default(1);
            $table->timestamps();

        });
        /**
         * 园区表
         */
        Schema::create('hospital', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('名字');
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
        Schema::dropIfExists('user');
    }
}
