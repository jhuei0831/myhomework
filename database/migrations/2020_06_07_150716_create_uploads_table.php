<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     * 這邊的student_id是學生資料表流水號，不是學號。
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_id')->comment('學生id');
            // $table->foreign('student_id')->references('students')->on('id')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('homework_id')->comment('作業id');
            // $table->foreign('homework_id')->references('homeworks')->on('id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('file')->comment('作業檔案');
            $table->string('grade')->nullable()->comment('成績');
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
        Schema::dropIfExists('uploads');
    }
}
