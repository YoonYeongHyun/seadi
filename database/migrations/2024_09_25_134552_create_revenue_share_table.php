<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('revenue_share', function (Blueprint $table) {
            $table->id(); // 수익 분배 관리번호 (no)
            $table->foreignId('no_user')->constrained('users')->onDelete('cascade'); // 수익을 배분받는 사용자
            $table->tinyInteger('level'); // 해당 사용자의 레벨
            $table->decimal('share_amount', 10, 2); // 배분받은 금액
            $table->timestamp('dt_reg')->useCurrent(); // 수익 분배일
        });
    }

    public function down()
    {
        Schema::dropIfExists('revenue_share');
    }

};
