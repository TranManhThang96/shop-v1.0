<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->comment('ma tu sinh cua don hang');
            $table->integer('customer_id')->nullable()->comment('id khach hang');
            $table->string('customer_name')->nullable()->comment('ten khach hang');
            $table->string('customer_phone')->nullable()->comment('sdt khach hang');
            $table->integer('province_id')->nullable()->comment('tinh/thanh');
            $table->integer('district_id')->nullable()->comment('quan/huyen');
            $table->integer('ward_id')->nullable()->comment('xa/phuong');
            $table->string('address')->nullable()->comment('dia chi don hang');
            $table->text('detail')->nullable()->comment('chi tiet don hang dang json');
            $table->integer('type')->comment('1 facebook, 2 zalo, 3 web...');
            $table->integer('status')->comment('trang thai don hang');
            $table->string('note')->nullable()->comment('ghi chu');
            $table->string('discount_id')->nullable()->default(0)->comment('giam gia theo bang discount');
            $table->string('reason')->nullable()->comment('khach hang phan hoi');
            $table->integer('product_qty')->nullable()->comment('so luong san pham');
            $table->double('customer_fee',10,2)->nullable()->comment('tong tien thu cua khach');
            $table->double('revenue',10,2)->nullable()->comment('doanh thu');
            $table->string('ship_fee')->nullable()->comment('phi ship');
            $table->string('cod_fee')->nullable()->comment('phi thu ho');
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
        Schema::dropIfExists('order');
    }
}
