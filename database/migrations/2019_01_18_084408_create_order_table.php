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
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->comment('ma tu sinh cua don hang');
            $table->integer('customer_id')->nullable()->comment('id khach hang');
            $table->string('customer_name')->nullable()->comment('ten khach hang');
            $table->string('customer_phone')->nullable()->comment('sdt khach hang');
            $table->string('address')->nullable()->comment('dia chi don hang');
            $table->text('detail')->nullable()->comment('chi tiet don hang dang json');
            $table->string('payment_method')->nullable()->comment('phuong thuc thanh toan');
            $table->integer('status')->comment('trang thai don hang');
            $table->string('note')->nullable()->comment('ghi chu');
            $table->string('reason')->nullable()->comment('khach hang phan hoi');
            $table->integer('product_qty')->nullable()->comment('so luong san pham');
            $table->double('customerFee',10,2)->nullable()->comment('tong tien thu cua khach');
            $table->double('revenue',10,2)->nullable()->comment('doanh thu');
            $table->string('shipFee')->nullable()->comment('phi ship');
            $table->string('codFee')->nullable()->comment('phi thu ho');
            $table->double('voucher',10,2)->nullable()->comment('tien giam gia');
            $table->string('voucher_code')->nullable()->comment('ma giam gia');
            $table->integer('province')->nullable()->comment('tinh/thanh');
            $table->integer('district')->nullable()->comment('quan/huyen');
            $table->integer('created_by')->nullable()->comment('duoc tao boi ai');
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
        Schema::dropIfExists('order');
    }
}
