@extends('layouts.app')

@section('title', 'マイページ')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="flex items-center gap-12 mb-16 ml-20">
        <div class="w-40 h-40 rounded-full overflow-hidden bg-gray-200 shrink-0">
            @if($user->profile && $user->profile->image)
                <img src="{{ asset('storage/' . $user->profile->image) }}" alt="プロフィール画像" class="w-full h-full object-cover">
            @endif
        </div>
        
        <div class="flex items-center justify-between flex-1">
            <h2 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h2>
            <a href="/mypage/profile" class="border border-red-500 text-red-500 font-bold px-8 py-2 rounded-md hover:bg-red-50 transition">
                プロフィールを編集
            </a>
        </div>
    </div>

    <div class="flex gap-10 border-b border-gray-200 py-4 mb-8 text-lg font-bold">
        <a href="{{ route('mypage.index') }}" 
           class="{{ request('tab') !== 'buy' ? 'text-red-500 border-b-2 border-red-500 pb-4 -mb-4' : 'text-gray-500 hover:text-gray-700 transition' }}">
            出品した商品
        </a>
        <a href="{{ route('mypage.index', ['tab' => 'buy']) }}" 
           class="{{ request('tab') === 'buy' ? 'text-red-500 border-b-2 border-red-500 pb-4 -mb-4' : 'text-gray-500 hover:text-gray-700 transition' }}">
            購入した商品
        </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-12">
        @php
            $displayItems = request('tab') === 'buy' ? $buyItems : $sellItems;
        @endphp

        @foreach($displayItems as $item)
            <a href="{{ route('items.show', ['item_id' => $item->id]) }}" class="group block">
                <div class="relative aspect-square mb-3">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" 
                         class="w-full h-full object-cover rounded-md shadow-sm group-hover:opacity-90 transition">
                    @if($item->is_sold)
                        <div class="absolute top-0 left-0 bg-red-600 text-white text-sm font-extrabold px-5 py-2.5 rounded-tl-md rounded-br-md uppercase tracking-wider">Sold</div>
                    @endif
                </div>
                <div class="space-y-1">
                    <h3 class="text-gray-800 font-medium truncate">{{ $item->name }}</h3>
                </div>
            </a>
        @endforeach

        @if($displayItems->isEmpty())
            <div class="col-span-full text-center text-gray-500 py-10">
                商品がありません。
            </div>
        @endif
    </div>
</div>
@endsection