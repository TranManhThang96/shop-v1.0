<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->nullable()->comment('id category');
            $table->string('name','255')->comment('ten san pham');
            $table->string('sku',32)->comment('sku tu sinh cua san pham');
            $table->string('barcode',32)->nullable()->comment('barcode san pham');
            $table->string('alias')->nullable()->comment('ten chuan seo');
            $table->double('price',10,2)->nullable()->comment('gia niem yet');
            $table->double('iprice',10,2)->nullable()->comment('gia nhap');
            $table->integer('discount_id')->default(0)->nullable()->comment('giam gia theo bang discount');
            $table->text('img_link')->nullable()->comment('anh chinh de hien thi');
            $table->text('img_list')->nullable()->comment('anh di kem');
            $table->integer('view')->nullable()->default(0)->comment('luot xem');
            $table->string('brand')->nullable()->comment('thuong hieu');
            $table->string('short_description')->nullable()->comment('mo ta ngan');
            $table->text('description')->nullable()->comment('mo ta day du');
            $table->integer('status')->default(1)->nullable()->comment('trang thai (active,notactive, hethang)');
            $table->integer('created_by')->nullable()->comment('duoc tao boi ai');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
