<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | COACHTECH</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900 font-sans leading-normal">

    {{-- ヘッダーの条件分岐 --}}
    {{-- ログイン・会員登録画面、または「ログイン中だけどメール認証が済んでいない」場合はシンプルヘッダー --}}
    @if(Request::is('register') || Request::is('login') || (Auth::check() && !Auth::user()->hasVerifiedEmail()))
        {{-- 会員登録・ログイン・メール認証待ち専用：黒背景・シンプルヘッダー --}}
        <header class="bg-black py-5 px-8 mb-10">
            <div class="flex justify-start items-center">
                <a href="/" class="hover:opacity-80 transition">
                    <img src="{{ asset('image/logo.png') }}" alt="COACHTECH" class="h-8 w-auto">
                </a>
            </div>
        </header>
    @else
        {{-- 【認証済み または 未ログインの商品一覧用】フル機能のヘッダー --}}
        <header class="bg-black text-white py-3 px-6 shadow-md sticky top-0 z-50">
            <div class="container mx-auto flex items-center justify-between gap-8">
                <h1 class="shrink-0">
                    <a href="/" class="hover:opacity-80 transition block">
                        <img src="{{ asset('image/logo.png') }}" alt="COACHTECH" class="h-9 w-auto block">
                    </a>
                </h1>

                <div class="flex-1 max-w-2xl relative">
                    <input type="text" placeholder="なにお探しですか？" 
                           class="w-full bg-white text-gray-900 border-none rounded-md py-1.5 px-4 focus:ring-2 focus:ring-gray-300">
                </div>

                <nav class="flex items-center gap-6 font-bold text-sm">
                    @auth
                        {{-- メール認証まで完全に終わった人 --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="hover:text-gray-300 transition">ログアウト</button>
                        </form>
                        <a href="/mypage" class="hover:text-gray-300 transition">マイページ</a>
                    @else
                        {{-- ログインしていない人 --}}
                        <a href="{{ route('login') }}" class="hover:text-gray-300 transition">ログイン</a>
                        <a href="{{ route('register') }}" class="hover:text-gray-300 transition">会員登録</a>
                    @endauth
                    <a href="#" class="bg-white text-black px-6 py-2 rounded-md hover:bg-gray-200 transition">出品</a>
                </nav>
            </div>
        </header>
    @endif

    {{-- コンテンツエリア --}}
    <main class="w-full">
        @yield('content')
    </main>

</body>
</html>