<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () { return view('layouts/app'); }) -> name('app');
Route::get('/home', function () { return view('home'); }) -> name('home');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

//컨트롤러 호출
Route::get('/dashboard', [RequestsController::class, 'loadRequestView'])->name('dashboard');



// AUTH View
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/profile/show', function () { return view('profile/show'); })->name('profile.show');
});

// Google 로그인 리디렉션
Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

// Google 로그인 콜백
Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    // 기존 사용자인지 확인
    $user = \App\Models\User::where('email', $googleUser->getEmail())->first();

    // 없으면 새로운 사용자 생성
    if (!$user) {
        $user = \App\Models\User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'password' => bcrypt(Str::random(16)), // 자동 생성된 비밀번호
        ]);
    }

    // 사용자 로그인 처리
    Auth::login($user);

    return redirect('/dashboard'); // 로그인 후 리다이렉트할 페이지
});
