<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('app_name')->comment('網站名稱');
            $table->string('font_family')->nullable()->comment('字體');
            $table->string('font_size')->nullable()->comment('字體大小');
            $table->string('font_weight')->nullable()->comment('字體粗細');
            $table->string('background')->nullable()->comment('背景');
            $table->string('background_color')->nullable()->comment('背景顏色');
            $table->string('navbar_wcolor')->nullable()->comment('導覽列字體顏色');
            $table->string('navbar_hcolor')->nullable()->comment('導覽列滑動顏色');
            $table->string('navbar_size')->nullable()->comment('導覽列字體大小');
            $table->boolean('is_open')->default(true)->comment('網站是否開放');
            $table->timestamps();
        });

        DB::table('configs')->insert([
            'app_name' => 'Website',
            'font_family' => 'Helvetica, Arial',
            'font_size' => 'large',
            'font_weight' => '200',
            'background_color' => 'null',
            'navbar_wcolor' => 'fff',
            'navbar_hcolor' => 'fff',
            'navbar_size' => 'large',
            'is_open' => '1',
            'created_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
