<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Exception;

class LoginController extends Controller
{
    // 구글로 리다이렉트
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // 구글로부터 유저 정보를 받아옴
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $findUser = User::where('google_id', $user->id)->orWhere('email', $user->email)->first();

            if ($findUser) {
                // 기존 사용자 로그인
                Auth::login($findUser);

                // 다른 브라우저에서의 세션 로그아웃
                Auth::logoutOtherDevices($findUser->password);

                return redirect()->intended('dashboard');
            } else {
                // 새로운 사용자 생성
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => Hash::make(uniqid()), // 비밀번호는 사용되지 않음 (랜덤한 값 설정)
                ]);

                Auth::login($newUser);

                return redirect()->intended('dashboard');
            }

        } catch (Exception $e) {
            // 에러 발생 시 로그인 페이지로 리디렉션
            return redirect('/login')->withErrors(['error' => 'Google login failed. Please try again.']);
        }
    }
}
