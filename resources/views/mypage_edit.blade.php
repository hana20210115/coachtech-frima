@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6 bg-white">
    <h2 class="text-2xl font-bold text-center mb-10">プロフィール設定</h2>

    @if (session('status'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-6 text-center">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="flex items-center mb-8">
            <div class="w-24 h-24 rounded-full overflow-hidden bg-gray-200 mr-6 shrink-0">
                @if($user->profile && $user->profile->image)
                    <img src="{{ asset('storage/' . $user->profile->image) }}" alt="プロフィール画像" class="w-full h-full object-cover">
                @endif
            </div>
            
            <label class="cursor-pointer border border-red-500 text-red-500 px-6 py-2 rounded text-sm font-bold bg-white hover:bg-red-50 transition">
                画像を選択する
                <input type="file" id="image" name="image" class="hidden">
            </label>
            @error('image')
                <p class="text-red-500 text-xs ml-4">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="name" class="block font-bold mb-2">ユーザー名</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 rounded p-3 focus:outline-none focus:border-gray-500">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="postcode" class="block font-bold mb-2">郵便番号</label>
            <input type="text" id="postcode" name="postcode" value="{{ old('postcode', $user->profile->postcode ?? '') }}" class="w-full border border-gray-300 rounded p-3 focus:outline-none focus:border-gray-500">
            @error('postcode')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="address" class="block font-bold mb-2">住所</label>
            <input type="text" id="address" name="address" value="{{ old('address', $user->profile->address ?? '') }}" class="w-full border border-gray-300 rounded p-3 focus:outline-none focus:border-gray-500">
            @error('address')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-10">

            <label for="building" class="block font-bold mb-2">建物名</label>
            <input type="text" id="building" name="building" value="{{ old('building', $user->profile->building ?? '') }}" class="w-full border border-gray-300 rounded p-3 focus:outline-none focus:border-gray-500">
            @error('building')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror

        </div>

        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded transition">
            更新する
        </button>
    </form>
</div>
@endsection