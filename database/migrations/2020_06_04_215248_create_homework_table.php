<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homeworks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('course')->comment('課程名稱');
            $table->foreign('course')->references('name')->on('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->string('subject')->unique()->comment('題目');
            $table->longText('description')->comment('敘述');
            $table->datetime('deadline')->comment('截止日期');
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
        Schema::dropIfExists('homeworks');
    }
}
