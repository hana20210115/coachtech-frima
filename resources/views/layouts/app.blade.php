<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'COACHTECH')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900 font-sans leading-normal">

  
    @if(Request::is('register') || Request::is('login') || Request::is('email/verify'))
        <header class="bg-black py-5 px-8 mb-10">
            <div class="flex justify-start items-center">
                <a href="{{ route('items.index') }}" class="hover:opacity-80 transition">
                    <img src="{{ asset('image/logo.png') }}" alt="COACHTECH" class="h-8 w-auto">
                </a>
            </div>
        </header>
    @else
    
        <header class="bg-black text-white py-3 px-6 shadow-md sticky top-0 z-50">
            <div class="container mx-auto flex items-center justify-between gap-8">
                
        
                <h1 class="shrink-0">
                    <a href="{{ route('items.index') }}" class="hover:opacity-80 transition block">
                        <img src="{{ asset('image/logo.png') }}" alt="COACHTECH" class="h-9 w-auto block">
                    </a>
                </h1>

           
                <form action="{{ route('items.index') }}" method="GET" class="flex-1 max-w-2xl relative">
                    @if(request('tab') === 'mylist')
                        <input type="hidden" name="tab" value="mylist">
                    @endif

                    <input type="text" 
                           name="keyword" 
                           value="{{ request('keyword') }}" 
                           placeholder="なにをお探しですか？" 
                           class="w-full bg-white text-gray-900 border-none rounded-md py-1.5 px-4 focus:outline-none focus:ring-2 focus:ring-gray-400">
                </form>

               
                <nav class="flex items-center gap-6 font-bold text-sm shrink-0">
                    @auth
                        
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="hover:text-gray-300 transition">ログアウト</button>
                        </form>
                        <a href="{{ route('mypage.index') }}" class="hover:text-gray-300 transition">マイページ</a>
                    @else
                       
                        <a href="{{ route('login') }}" class="hover:text-gray-300 transition">ログイン</a>
                        <a href="{{ route('register') }}" class="hover:text-gray-300 transition">会員登録</a>
                    @endauth
                    
                   
                    <a href="{{ route('item.sell') }}" class="bg-white text-black px-6 py-2 rounded-md hover:bg-gray-200 transition">出品</a>
                </nav>
            </div>
        </header>
    @endif

    <main class="w-full pb-20">
        @yield('content')
    </main>

</body>
</html>