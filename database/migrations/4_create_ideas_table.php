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
            $table->id();                                   // 아이디어 게시물 관리번호 (no)
            $table->string('category_code');                // 카테고리 코드
            $table->string('title');                        // 제목
            $table->text('content');                        // 내용
            $table->string('thumbnail_path');               // 썸네일 경로
            $table->integer('like_cnt')->default(0);        // 좋아요 수
            $table->string('created_name');                 // 작성자 이름
            $table->string('created_id');                   // 작성자 id
            $table->string('updated_id');                   // 수정자 id
            $table->integer('view_cnt')->default(0);        // 조회수
            $table->timestamp('created_at')->useCurrent();  // 작성일
            $table->timestamp('updated_at')->nullable();    // 수정일
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
