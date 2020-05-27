<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('menu_id')->comment('選單id');
            $table->string('title')->comment('標題');
            $table->string('icon')->nullable()->comment('icon');
            $table->integer('width')->nullable()->comment('寬度');
            $table->longText('content')->comment('內容');
            $table->string('is_open')->comment('是否開放');
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
        Schema::dropIfExists('notices');
    }
}
