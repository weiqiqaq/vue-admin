<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 地址表
         */
        Schema::create('address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('名字');
            $table->string('phone')->comment('电话');
            $table->string('address')->comment('地址');
            $table->string('status')->comment('是否默认'); //0 不默认 1 默认
            $table->unsignedBigInteger('user_id')->comment('用户id')->nullable();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('CASCADE');
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
        Schema::dropIfExists('address');
    }
}
