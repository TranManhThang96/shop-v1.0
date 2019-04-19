<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code',32)->comment('ma hoa don tu sinh');
            $table->integer('supplier_id')->nullable()->comment('id nha cung cap');
            $table->double('money_total')->default(0)->comment('tong tien');
            $table->integer('quantity_total')->default(0)->comment('so luong');
            $table->string('note',255)->nullable()->comment('ghi chu');
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
        Schema::dropIfExists('import_invoice');
    }
}
