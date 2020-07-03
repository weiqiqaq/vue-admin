<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 商品类目
         */
        Schema::create('food_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('类目名称')->nullable();
            $table->timestamps();
        });

        /**
         * 商品表
         */
        Schema::create('food', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('food_id')->comment('商品id')->nullable();
            $table->bigInteger('food_item')->comment('商品货号')->nullable();
            $table->string('name')->comment('商品名称');
            $table->float('price')->comment('商品价格');
            $table->unsignedBigInteger('business_id')->comment('商家id')->nullable();
            $table->foreign('business_id')->references('id')->on('business')->onDelete('CASCADE');
            $table->float('market_price')->comment('市场价格')->nullable();
            $table->bigInteger('food_num')->comment('商品库存')->nullable();
            $table->bigInteger('number')->comment('数量--前端好传值')->default('0');
            $table->text('body')->comment('商品描述')->nullable();
            $table->string('image')->comment('商品图片')->nullable();
            $table->bigInteger('num')->comment('销量')->nullable();
            $table->bigInteger('sort')->comment('排序')->nullable();
            $table->boolean('Recommend')->comment('是否推荐')->default('0');
            $table->boolean('new_products')->comment('是否新品')->default('0');
            $table->boolean('hot_sale')->comment('是否热卖')->default('0');
            $table->boolean('status')->comment('是否上架')->default('0');
            $table->unsignedBigInteger('category_id')->comment('类目')->nullable();
            $table->foreign('category_id')->references('id')->on('food_category')->onDelete('CASCADE');

            $table->timestamps();
        });
        /**
         * 商品 分类 中间表
         * */
        Schema::create('food_classification_he', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('food_id')->nullable();
            $table->foreign('food_id')->references('id')->on('food')->onDelete('CASCADE');
            $table->unsignedBigInteger('classification_id')->nullable();
            $table->foreign('classification_id')->references('id')->on('food_classification')->onDelete('CASCADE');
            $table->timestamps();
            $table->unique(['food_id','classification_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_classification_he');
        Schema::dropIfExists('food');
        Schema::dropIfExists('food_category');
    }
}
