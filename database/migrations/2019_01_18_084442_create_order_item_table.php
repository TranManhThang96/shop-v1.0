<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->comment('id don hang');
            $table->integer('product_item_id')->nullable()->comment('id san pham');
            $table->integer('quantity')->nullable()->comment('so luong');
            $table->string('name')->nullable()->comment('ten san pham');
            $table->string('sku')->nullable()->comment('ma san pham');
            $table->string('img')->nullable()->comment('anh san pham');
            $table->double('price',10,2)->nullable()->comment('gia niem yet');
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
        Schema::dropIfExists('order_item');
    }
}
