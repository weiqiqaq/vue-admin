<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //用户当前优惠券 这个表有unique 控制用户当前只能有一个类型的优惠券 这个表有新数据时候要删除
//        Schema::create('bonus', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->unsignedBigInteger('record_id')->unique();
//            $table->unsignedBigInteger('user_id')->comment('优惠券用户');
//            $table->foreign('record_id')->references('id')->on('bonus_record');
//            $table->foreign('user_id')->references('id')->on('user');
//            $table->tinyInteger('type')->comment('1:A 2:B 3:C 三种类型');
//            $table->timestamps();
//            $table->unique(['type','user_id']);
//        });
        //优惠券类型 后台设置优惠券类型对应的金额 以便于发放优惠券的时候 上表bonus_record的金额有参照
        Schema::create('bonus_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            //名称唯一
            $table->string('type_name')->comment('优惠券名称 暂定 A B C')->unique();
            $table->float('fee')->comment('优惠金额')->default(0);
            $table->timestamps();
        });
        //用户优惠券清单 包括当前的优惠券和历史的优惠券
        Schema::create('bonus_record', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('fee')->comment('优惠金额')->default(0);
            $table->string('no')->comment('优惠券编号');
            $table->unsignedBigInteger('user_id')->comment('优惠券用户');
            $table->foreign('user_id')->references('id')->on('user');
            $table->unsignedBigInteger('type')->comment('1:A 2:B 3:C三种类型')->nullable();
            $table->foreign('type')->references('id')->on('bonus_type')->onDelete('set null');
            $table->boolean('is_used')->comment('优惠券是否已经使用')->default(false);
            $table->timestamp('use_time')->comment('优惠券使用时间')->default(null);
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
     //   Schema::dropIfExists('bonus');
        Schema::dropIfExists('bonus_record');
        Schema::dropIfExists('bonus_type');
    }
}
