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
        Schema::create('ideas', function (Blueprint $table) {
            $table->id(); // 아이디어 게시물 관리번호 (no)
            $table->string('title'); // 제목
            $table->string('ideas_category'); // 카테고리
            $table->string('writer_id'); // 작성자 이름
            $table->string('thumbnail_path'); // 썸네일 경로
            $table->integer('like_cnt')->default(0); // '좋아요'수
            $table->integer('view_cnt')->default(0); // 조회수
            $table->timestamp('dt_reg')->useCurrent(); // 작성일
            $table->timestamp('dt_upt')->nullable(); // 수정일
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ideas');
    }
};
