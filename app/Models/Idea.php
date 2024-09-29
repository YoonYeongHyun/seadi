<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    protected $table = 'ideas'; // 테이블 이름 (지정하지 않으면 class name으로 지정)

    public $timestamps = true; // timestamps 활성화 여부 (created_at 및 updated_at 컬럼)

    protected $primaryKey = 'ideas_id'; // 기본키(Primarykey)
    public $incrementing = false; // 기본키가 증가하는 정수는 true, 증가하지 않거나 문자열이라면 false
    
    
    //protected  $fillable = ['id','name','phone']; // 대량 할당 허용 컬럼
    protected $guarded = []; // 대량 할당 불허 컬럼 (공백: 모두 허용)

}
