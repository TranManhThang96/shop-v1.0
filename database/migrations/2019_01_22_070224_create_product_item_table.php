<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->comment('id sản phẩm');
            $table->integer('quantity')->comment('so luong');
            $table->string('color')->nullable()->comment('màu sắc');
            $table->string('size')->nullable()->comment('kích cỡ (M,L,31,32)');
            $table->integer('ram')->nullable()->comment('ram theo GB');
            $table->integer('rom')->nullable()->comment('bo nho trong theo GB');
            $table->integer('created_by')->nullable()->comment('tao boi ai');
            $table->integer('updated_by')->nullable()->comment('cap nhat boi ai');
            $table->softDeletes();
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
        Schema::dropIfExists('table_product_item');
    }
}
