<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->comment('id don hang');
            $table->integer('product_id')->nullable()->comment('id san pham');
            $table->integer('quantity')->nullable()->comment('so luong');
            $table->string('product_name')->nullable()->comment('ten san pham');
            $table->string('product_code')->nullable()->comment('ma san pham');
            $table->string('product_img')->nullable()->comment('anh san pham');
            $table->double('product_price',10,2)->nullable()->comment('gia niem yet');
            $table->double('product_iprice',10,2)->nullable()->comment('gia nhap');
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
        Schema::dropIfExists('order_detail');
    }
}
