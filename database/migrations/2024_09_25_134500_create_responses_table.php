<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id(); // 답변 고유 식별자 (no)2
            $table->foreignId('no_request')->constrained('requests')->onDelete('cascade'); // 아이디어 요청 ID (no_request)
            $table->foreignId('no_user')->constrained('users')->onDelete('cascade'); // 답변자 사용자 ID (no_user)
            $table->text('content'); // 답변 내용
            $table->boolean('is_accepted')->default(false); // 채택 여부
            $table->timestamps(); // 등록일, 수정일 (created_at, updated_at)
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('responses');
    }
    
};
