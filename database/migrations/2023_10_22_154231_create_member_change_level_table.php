<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberChangeLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_change_level', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable()->comment('會員ID');
            $table->string('email')->nullable()->comment('電郵');
            $table->string('member_type')->nullable()->comment('會員類型');
            $table->string('action_type')->nullable()->comment('申請類型');
            $table->integer('status')->nullable()->comment('審核狀態');
            $table->string('remark')->nullable()->comment('備注');
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
        Schema::dropIfExists('member_change_level');
    }
}
