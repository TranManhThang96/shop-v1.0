<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent')->nullable()->comment('comment cha');
            $table->text('content')->comment('noi dung comment');
            $table->integer('type')->default(1)->comment('loai comment 1 la sp, 2 la bai viet');
            $table->integer('relationship_id')->comment('id khoa ngoai san pham hoac bai viet');
            $table->integer('created_by')->nullable()->comment('tao boi ai');
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
        Schema::dropIfExists('comment');
    }
}
