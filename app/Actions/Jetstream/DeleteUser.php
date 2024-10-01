<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesUsers;
use Illuminate\Support\Facades\Session;  // 세션 처리를 위한 패사드
use Illuminate\Support\Facades\Auth;     // 로그아웃 처리를 위한 패사드

class DeleteUser implements DeletesUsers
{
    /**
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        // 상태를 'N'으로 변경
        $user->status = 'N';
        $user->save();

        // 사용자 세션 삭제
        Session::flush();  // 모든 세션 데이터 삭제

        // 현재 사용자 로그아웃 처리 (web 가드 사용)
        Auth::guard('web')->logout();
    }
}
