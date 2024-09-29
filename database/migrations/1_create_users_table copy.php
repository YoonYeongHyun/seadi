<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // 사용자 관리번호 (no)
            $table->string('name'); // 사용자명
            $table->string('nickname')->default('anonymous'); // 기본값 설정
            $table->string('email')->unique(); // 이메일        
            $table->string('google_id')->nullable();
            $table->string('password'); // 비밀번호
            $table->tinyInteger('level')->default(1); // 사용자 레벨 (1~99)
            $table->boolean('subscription_required')->default(false); // 유료 구독 여부
            $table->integer('total_responses')->default(0); // 총 답변 수
            $table->integer('total_request')->default(0); // 총 요청 수
            $table->timestamp('email_verified_at')->nullable(); // 이메일 인증
            $table->rememberToken();
            $table->timestamp('dt_reg')->useCurrent(); // 가입일 (자동으로 현재 시간을 저장)
            $table->timestamp('dt_upt')->nullable()->useCurrentOnUpdate(); // 수정일 (업데이트 시 자동 갱신)
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('dt_reg')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
