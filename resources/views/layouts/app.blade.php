<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | COATCHTECH</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900 font-sans leading-normal">

  <header class="bg-black text-white py-3 px-6 shadow-md sticky top-0 z-50">
    <div class="container mx-auto flex items-center justify-between gap-8">
        <h1 class="shrink-0">
            <a href="/" class="hover:opacity-80 transition block">
                <img src="{{ asset('image/logo.png') }}" alt="COATCHTECH" class="h-9 w-auto block">
            </a>
        </h1>

        <div class="flex-1 max-w-2xl relative">
            <input type="text" placeholder="なにお探しですか？" 
                   class="w-full bg-white text-gray-900 border-none rounded-md py-1.5 px-4 focus:ring-2 focus:ring-gray-300">
        </div>

        <nav class="flex items-center gap-6 font-bold text-sm">
            <a href="#" class="hover:text-gray-300 transition">ログイン</a>
            <a href="#" class="hover:text-gray-300 transition">会員登録</a>
            <a href="#" class="bg-white text-black px-6 py-2 rounded-md hover:bg-gray-200 transition">出品</a>
        </nav>
    </div>
</header>

    <main class="container mx-auto px-4 py-12">
        @yield('content')
    </main>

    

</body>
</html>