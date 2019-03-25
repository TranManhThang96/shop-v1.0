<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriceProductItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_item', function (Blueprint $table) {
            $table->double('price',10,2)->after('quantity')->nullable()->comment('gia niem yet');
            $table->double('iprice',10,2)->after('price')->nullable()->comment('gia nhap');
            $table->integer('discount_id')->after('iprice')->default(0)->nullable()->comment('giam gia theo bang discount');
            $table->string('sku_item',32)->after('id')->comment('sku tu sinh cua san pham con');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_item', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('iprice');
            $table->dropColumn('discount_id');
            $table->dropColumn('sku_item');
        });
    }
}
