<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',32)->comment('title');
            $table->integer('invoice_id')->nullable()->comment('id hoa don');
            $table->integer('product_item_id')->comment('product item');
            $table->integer('old_quantity')->default(0)->comment('so luong ban dau');
            $table->integer('new_quantity')->comment('so luong sau khi tac dong');
            $table->integer('created_by')->nullable()->comment('tao boi ai');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_log');
    }
}
