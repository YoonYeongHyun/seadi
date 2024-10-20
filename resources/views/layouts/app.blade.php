<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="">
        <x-banner />
        <div class="min-h-screen dark:bg-gray-900">
            @livewire('navigation-menu')
            
            <!-- Page Heading -->
            @if (isset($header))
                <header class=" dark:bg-gray-800 shadow">
                    <div class="basis_1_3 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @if (isset($slot))
                    {{ $slot }}
                @endif
            </main>
        </div>

        @stack('modals')

        @livewireScripts        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // 로컬 저장소에 다크모드 상태를 저장하고 불러오기 위한 함수
                const themeToggleBtn = document.getElementById('theme-toggle');
                const themeToggleIcon = document.getElementById('theme-toggle-icon');

                // 사용자가 이전에 설정한 테마를 로컬 저장소에서 불러오기
                if (localStorage.getItem('theme') === 'dark') {
                    document.documentElement.classList.add('dark');
                    themeToggleIcon.textContent = '☀️'; // 라이트 모드 아이콘
                } else {
                    document.documentElement.classList.remove('dark');
                    themeToggleIcon.textContent = '🌙'; // 다크 모드 아이콘
                }

                themeToggleBtn.addEventListener('click', () => {
                    // 다크모드가 활성화되어 있으면 제거하고, 그렇지 않으면 추가
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('theme', 'light'); // 라이트 모드 저장
                        themeToggleIcon.textContent = '🌙'; // 다크 모드 아이콘
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('theme', 'dark'); // 다크 모드 저장
                        themeToggleIcon.textContent = '☀️'; // 라이트 모드 아이콘
                    }
                });
            });
        </script>
    </body>
</html>
