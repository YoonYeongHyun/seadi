<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RequestsController;
use Illuminate\Support\Str; // Str 클래스를 추가


// 기본 라우트 설정
Route::get('/', function () {
    return view('layouts/app');
})->name('app');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// 컨트롤러 호출
Route::get('/about', [RequestsController::class, 'loadRequestView'])->name('about');

// AUTH View
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/profile/show', function () {
        return view('profile/show');
    })->name('profile.show');
});

// Google 로그인 리디렉션
Route::get('/auth/google', function () {
    return Socialite::driver('google')->stateless()->redirect(); // 상태 검증을 무시하기 위해 stateless 추가
})->name('google.login');

// Google 로그인 콜백
Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user(); // stateless를 추가하여 상태 검증을 피함

    // 기존 사용자인지 확인
    $user = \App\Models\User::where('email', $googleUser->getEmail())->first();

    // 없으면 새로운 사용자 생성
    if (!$user) {
        $user = \App\Models\User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'password' => bcrypt(Str::random(16)), // 비밀번호는 랜덤 생성하지만 실제 사용하지 않음
        ]);
    } else {
        // 구글 아이디가 기존 사용자와 다를 경우 업데이트
        if (!$user->google_id) {
            $user->google_id = $googleUser->getId();
            $user->save(); // 업데이트 후 저장
        }
    }

    // 사용자 로그인 처리
    Auth::login($user);

    return redirect('/dashboard'); // 로그인 후 리다이렉트할 페이지
});
