<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members',function(Blueprint $table){
            $table->integer('member_fee_status')->default(0)->comment('会员状态 0 默认 正常 1 即将过期 等待后台设置修改支付状态 ');
            $table->timestamp('member_expired_at')->nullable()->comment('会员费过期时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
