<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('姓名');
            $table->string('student_id')->unique()->comment('學號');
            $table->string('email')->unique()->comment('信箱');
            $table->timestamp('email_verified_at')->nullable()->comment('信箱驗證');
            $table->string('password')->comment('密碼');
            $table->integer('permission')->default('0')->comment('權限');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'name' => 'Admin',
                'student_id' => '7106093035',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'permission' => '5',
                'created_at' => now(),
            )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
