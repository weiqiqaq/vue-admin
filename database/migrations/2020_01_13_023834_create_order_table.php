<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /**
         * 订单表
         */
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('下订单的用户id')->nullable();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('no action');
            $table->unsignedBigInteger('business_id')->comment('订单对应的商户');
            $table->foreign('business_id')->on('business')->references('id')->onDelete('no action');
            $table->string('no')->unique()->comment('订单号 唯一');
            $table->integer('type')->unique()->comment('1线上 2线下')->default(2);
            $table->float('total_fee')->comment('订单未优惠的总金额');
            $table->float('fee')->comment('订单优惠后的金额');
            $table->float('bonus_fee')->comment('优惠券优惠金额');
            $table->float('bonus_another')->comment('预留接口 其他优惠金额')->default(0);
            $table->string('plat_orderid')->comment('支付宝或微信返回的平台订单号')->nullable();
            $table->string('plat_order')->comment('支付宝或微信返回的平台流水号')->nullable();
            $table->float('plat_fee')->comment('支付宝或微信返回的用户实际付款金额')->nullable();
            $table->boolean('pay_status')->comment('付款状态 false:未付款 true:已付款')->default(false);
            $table->tinyInteger('trans_status')->comment('配送状态 1.未配送 2.配送中 3. 配送完成')->default(1);
            $table->tinyInteger('user_delete')->comment('用户删除 0.未删除 1.用户删除')->default(0);
            $table->tinyInteger('business_delete')->comment('商家删除 0.未删除 1.商家删除')->default(0);
            $table->boolean('status')->comment('订单状态 false.未完成 true.订单完成')->default(false);
            $table->tinyInteger('accept')->comment('是否接单 0:未接单 1:已接单 2:拒绝接单')->default(0);
            $table->boolean('is_confirm')->comment('用户是否确认提交订单')->default(false);
            $table->tinyInteger('is_revoke')->comment('用户是否撤销订单')->default(0);
            $table->boolean('active')->comment('订单状态 后台通过这个来判定订单是否可以修改之类的')->default(true);
            $table->unsignedBigInteger('bonus_id')->comment('订单对应优惠券')->nullable();
            $table->foreign('bonus_id')->on('bonus_record')->references('id')->onDelete('no action');
            $table->integer('cover')->comment('餐具数量')->default(0);
            $table->string('desc')->comment('备注信息')->default('无备注');
            $table->string('name')->comment('姓名')->default('没有备注姓名');
            $table->string('phone')->comment('电话号码');
            $table->string('address')->comment('收货地址');
            $table->boolean('is_bale')->comment('是否打包 false.不打包 true.打包')->default(true);
        //    $table->unsignedBigInteger('flavor')->comment('口味选择')->nullable();
            $table->timestamp('finish_time')->comment('订单完成时间')->default(null);
            $table->string('revoke_reason')->comment('撤销订单的原因')->default(null);
            $table->string('because')->comment('失败订单的原因')->default(null);
            $table->timestamps();
        });

        Schema::create('order_goods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->comment('订单id号')->nullable();
            $table->unsignedBigInteger('good_id')->comment('商品')->nullable();
            $table->float('fee')->comment('下单时该商品的价格');
            $table->integer('num')->comment('下单时该商品的数量');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
            $table->foreign('good_id')->references('id')->on('food')->onDelete('set null');
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
        Schema::dropIfExists('orders_goods');
        Schema::dropIfExists('orders');
    }
}
