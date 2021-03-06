<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportInvoiceItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_invoice_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->comment('id hoa don nhap');
            $table->integer('product_item_id')->comment('id san pham');
            $table->string('sku',32)->comment('ma code san pham');
            $table->string('name','255')->comment('ten san pham');
            $table->double('iprice',10,2)->comment('gia nhap');
            $table->integer('quantity')->comment('so luong');
            $table->string('image')->comment('hinh anh san pham');
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
        Schema::dropIfExists('import_invoice_item');
    }
}
