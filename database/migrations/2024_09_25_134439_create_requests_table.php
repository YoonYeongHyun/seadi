<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id(); // 요청 고유 식별자 (no)1
            $table->foreignId('no_user')->constrained('users')->onDelete('cascade'); // 요청자 사용자 ID (no_user)
            $table->string('title'); // 아이디어 제목
            $table->text('content'); // 아이디어 설명
            $table->boolean('is_paid')->default(false); // 유료/무료 여부
            $table->timestamps(); // 등록일, 수정일 (created_at, updated_at)
        });
    }

    public function down()
    {
        Schema::dropIfExists('requests');
    }

};
