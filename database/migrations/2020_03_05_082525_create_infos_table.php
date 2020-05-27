<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('標題');
            $table->longText('content')->comment('內容');
            $table->string('editor')->comment('編輯者');
            $table->string('sort')->nullable()->comment('置頂排序');
            $table->boolean('is_open')->comment('是否開放');
            $table->boolean('is_sticky')->comment('是否置頂');
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
        Schema::dropIfExists('infos');
    }
}
