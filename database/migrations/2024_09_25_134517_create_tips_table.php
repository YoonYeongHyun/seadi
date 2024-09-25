<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tips', function (Blueprint $table) {
            $table->id(); // 팁 관리번호 (no)
            $table->foreignId('no_user')->constrained('users')->onDelete('cascade'); // 팁을 준 사용자
            $table->foreignId('no_request')->constrained('requests')->onDelete('cascade'); // 팁이 달린 요청
            $table->foreignId('no_response')->constrained('responses')->onDelete('cascade'); // 팁이 달린 답변
            $table->decimal('amount', 10, 2); // 팁 금액
            $table->timestamp('dt_reg')->useCurrent(); // 팁 지급 날짜
        });
    }

    public function down()
    {
        Schema::dropIfExists('tips');
    }

};
