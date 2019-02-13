<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->comment('ma khach hang tu sinh');
            $table->string('name')->comment('ho ten day du');
            $table->string('email')->nullable()->comment('email khach hang');
            $table->integer('sex')->nullable()->comment('gioi tinh (1 nam,2 nu)');
            $table->integer('age')->nullable()->comment('tuoi');
            $table->string('user_name')->nullable()->comment('ten dang nhap');
            $table->string('password')->nullable()->comment('mat khau');
            $table->string('phone')->nullable()->comment('so dien thoai khach hang');
            $table->integer('province')->nullable()->comment('tinh/thanh');
            $table->integer('district')->nullable()->comment('quan/huyen');
            $table->integer('ward')->nullable()->comment('xa/phuong');
            $table->string('street')->nullable()->comment('thon/xom/sonha');
            $table->integer('created_by')->nullable()->comment('tao boi ai');
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
        Schema::dropIfExists('customers');
    }
}
