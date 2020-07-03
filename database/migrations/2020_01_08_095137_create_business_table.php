<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 商家表
         */
        Schema::create('business', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_title')->comment('商家名称');
            $table->string('user_name')->comment('账户');
            $table->string('password')->comment('密码');
            $table->boolean('user_status')->comment('账户状态')->default('1'); //0禁用 1启用
            $table->string('name')->comment('商家联系人')->nullable();
            $table->bigInteger('phone')->comment('商家手机号')->nullable();
            $table->bigInteger('business_phone')->comment('店铺手机号')->nullable();
            $table->string('address')->comment('商家地址')->nullable();
            $table->float('consumption')->comment('人均消费')->nullable();
            $table->float('cost')->comment('配送费用')->default('0');
            $table->text('body')->comment('店铺介绍')->nullable();
            $table->unsignedBigInteger('business_class')->comment('商家分类')->nullable();
            $table->boolean('status')->comment('商家状态')->default('0'); //0审核中 1审核成功 2审核失败
            $table->string('because')->comment('原因')->nullable();
            $table->string('class')->comment('分类')->nullable();
            $table->double('fee')->comment('线上余额')->default(0);
            $table->double('to_fee')->comment('线下余额')->default(0);
            $table->integer('area')->comment('0 院内，1 院外')->default(1);
            $table->boolean('bonus_status')->comment('商家是否可以使用优惠券')->default('0'); //0不能 1可以
            $table->bigInteger('sales')->comment('月销量')->nullable()->default('0');
            $table->string('shop_image')->comment('店铺形象图')->nullable();
             $table->string('Business_license')->comment('营业执照图')->nullable();
           $table->string('login_code',6)->comment('登录使用的code')->nullable();
            $table->timestamp('login_code_time')->comment('登录码发送的时间 用于查看注册码是否失效')->nullable();
            $table->timestamps();
        });
        /**
         * 商家表
         */
        Schema::create('business_time', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Time('start_time')->comment('营业开始时间');
            $table->Time('end_time')->comment('营业结束时间');
            $table->tinyInteger('day')->comment('营业天'); //1 星期1 2 星期2 3 星期3 .. 0 星期天
            $table->unsignedBigInteger('business_id')->comment('对应商家')->nullable();
            $table->foreign('business_id')->references('id')->on('business')->onDelete('CASCADE');
            $table->timestamps();
            $table->unique(['day','business_id']);

        });


        /**
         * 商家分类3
         */
        Schema::create('business_classification', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name')->comment('商家分类名字');
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
        //
        Schema::dropIfExists('business_classification_he');
        Schema::dropIfExists('business_classification');
        Schema::dropIfExists('business_time');
        Schema::dropIfExists('business_image');
        Schema::dropIfExists('business');
    }
}
