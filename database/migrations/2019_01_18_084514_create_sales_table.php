<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->comment('ten chuong trinh khuyen mai');
            $table->integer('type')->default(1)->comment('1 la tien, 0 la phan tram');
            $table->double('sale')->default(0)->comment('khuyen mai');
            $table->integer('created_by')->nullable()->comment('tao boi ai');
            $table->timestamp('start')->nullable()->comment('thoi gian bat dau');
            $table->timestamp('end')->nullable()->comment('thoi gian ket thuc');
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
        Schema::dropIfExists('sales');
    }
}
