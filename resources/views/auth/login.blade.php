
@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto pt-16 pb-10 px-6 bg-white">
    <h2 class="text-2xl font-bold text-center mb-10">ログイン</h2>

   
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-6 text-sm">
            メールアドレスまたはパスワードが正しくありません。
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

      
        <div class="mb-6">
            <label for="email" class="block font-bold mb-2 text-sm">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus class="w-full border border-gray-300 rounded p-3 focus:outline-none focus:border-gray-500">
        </div>

        <div class="mb-10">
            <label for="password" class="block font-bold mb-2 text-sm">パスワード</label>
            <input type="password" id="password" name="password" required class="w-full border border-gray-300 rounded p-3 focus:outline-none focus:border-gray-500">
        </div>

        <button type="submit" class="w-full bg-[#ed6163] hover:bg-red-500 text-white font-bold py-3 rounded transition mb-6">
            ログインする
        </button>

       
        <div class="text-center">
            <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700 text-sm">
                会員登録はこちら
            </a>
        </div>
    </form>
</div>
@endsection