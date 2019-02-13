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
            $table->integer('length')->nullable()->comment('chieu dai(cm)');
            $table->integer('width')->nullable()->comment('chieu rong (cm)');
            $table->integer('height')->nullable()->comment('chieu cao (cm)');
            $table->integer('weight')->nullable()->comment('can nang (gam)');
            $table->string('color')->nullable()->comment('màu sắc');
            $table->string('size')->nullable()->comment('kích cỡ (M,L,31,32)');
            $table->integer('created_by')->nullable()->comment('được tạo bởi ai');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
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
