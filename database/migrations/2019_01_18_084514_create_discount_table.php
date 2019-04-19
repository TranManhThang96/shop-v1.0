<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->comment('ten chuong trinh khuyen mai');
            $table->string('code',32)->nullable()->comment('ma chuong trinh khuyen mai');
            $table->integer('type')->default(1)->comment('1 la tien, 2 la phan tram');
            $table->integer('type_by')->default(1)->comment('1 la theo san pham,2 la theo don hang');
            $table->double('discount')->default(0)->comment('khuyen mai');
            $table->integer('created_by')->nullable()->comment('tao boi ai');
            $table->integer('updated_by')->nullable()->comment('cap nhat boi ai');
            $table->softDeletes();
            $table->timestamp('start')->nullable()->comment('thoi gian bat dau');
            $table->timestamp('end')->nullable()->comment('thoi gian ket thuc');
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
        Schema::dropIfExists('discount');
    }
}
