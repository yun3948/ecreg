<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('member_id')->comment('會員ID'); 
           
            $table->string('type')->nullable()->default('')->comment('類型 mail  level ');
            $table->string('message')->default('')->comment('日志詳情');

            $table->string('email')->nullable()->default('')->comment('郵箱');
            $table->text('content')->nullable()->default('')->comment('内容详情');
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
        Schema::dropIfExists('member_log');
    }
}
