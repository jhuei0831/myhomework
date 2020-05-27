<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user')->comment('使用者');
            $table->string('ip')->comment('使用者IP');
            $table->string('os')->comment('作業系統');
            $table->string('browser')->comment('瀏覽器');
            $table->string('browser_detail')->comment('瀏覽器詳細資料');
            $table->string('action')->comment('動作');
            $table->string('table')->comment('資料表');
            $table->json('data')->comment('資料');
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
        Schema::dropIfExists('logs');
    }
}
