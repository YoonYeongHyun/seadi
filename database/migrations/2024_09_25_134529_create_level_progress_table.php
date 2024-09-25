<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('level_progress', function (Blueprint $table) {
            $table->id(); // 진행 관리번호 (no)
            $table->foreignId('no_user')->constrained('users')->onDelete('cascade'); // 해당 레벨을 달성한 사용자
            $table->tinyInteger('level'); // 달성한 레벨
            $table->integer('user_cnt')->default(0); // 해당 레벨을 달성한 사용자 수
            $table->integer('responses_cnt')->default(0); // 레벨 달성에 필요한 답변 수
            $table->boolean('event_participation')->default(false); // 이벤트 참여 여부
            $table->timestamp('dt_reg')->useCurrent(); // 레벨 달성일
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('level_progress');
    }
    
};
