@extends('layouts.app')

@section('title', '会員登録')

@section('content')
<div class="flex flex-col items-center pt-20 min-h-[calc(100vh-200px)] bg-white">
    
    <h1 class="text-3xl font-bold text-center mb-16 text-gray-900">会員登録</h1>

    <div class="w-full max-w-xl px-4">

        <form method="POST" action="{{ route('register') }}" novalidate 
        onsubmit="this.querySelector('button[type=submit]').disabled=true;" class="space-y-10">

        <form method="POST" action="{{ route('register') }}" onsubmit="this.querySelector('button[type=submit]').disabled=true;" class="space-y-10">
            @csrf

            <div class="space-y-3">
                <label for="name" class="block text-xl font-bold text-gray-900">ユーザー名</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                       class="w-full border border-gray-400 rounded-md py-4 px-5 text-xl outline-none focus:ring-2 focus:ring-gray-300 transition">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-3">
                <label for="email" class="block text-xl font-bold text-gray-900">メールアドレス</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                       class="w-full border border-gray-400 rounded-md py-4 px-5 text-xl outline-none focus:ring-2 focus:ring-gray-300 transition">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-3">
                <label for="password" class="block text-xl font-bold text-gray-900">パスワード</label>
                <input id="password" type="password" name="password" required
                       class="w-full border border-gray-400 rounded-md py-4 px-5 text-xl outline-none focus:ring-2 focus:ring-gray-300 transition">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-3">
                <label for="password_confirmation" class="block text-xl font-bold text-gray-900">確認用パスワード</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                       class="w-full border border-gray-400 rounded-md py-4 px-5 text-xl outline-none focus:ring-2 focus:ring-gray-300 transition">
            </div>

            <div class="pt-8">
                <button type="submit" 
                        class="w-full bg-[#EA6B6B] text-white font-bold py-5 rounded-md hover:bg-[#D95B5B] transition text-2xl tracking-widest">
                    登録する
                </button>
            </div>

            <div class="text-center pt-4 pb-10">
                <a href="{{ route('login') }}" class="text-blue-600 text-lg hover:underline">
                    ログインはこちら
                </a
            </div>
        </form>
    </div>
</div>
@endsection