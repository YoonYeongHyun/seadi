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
        Schema::create('ideas_files', function (Blueprint $table) {
            $table->id(); // 기본생성 no
            $table->string('ideas_id'); //게시글 id
            $table->string('file_name')->unique(); // 파일명
            $table->string('file_path')->unique(); // 파일경로
            $table->timestamp('created_at')->useCurrent(); // 가입일 (자동으로 현재 시간을 저장)
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate(); // 수정일 (업데이트 시 자동 갱신)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
