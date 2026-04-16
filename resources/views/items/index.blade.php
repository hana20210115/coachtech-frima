@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    
    <div class="flex gap-10 border-b border-gray-200 py-6 mb-8 text-lg font-bold">
        <a href="/" class="text-red-500 border-b-2 border-red-500 pb-6 -mb-6">おすすめ</a>
        <a href="/?tab=mylist" class="text-gray-500 hover:text-gray-700 transition">マイリスト</a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-x-6 gap-y-12">
        @foreach($items as $item)
            <a href="{{ route('items.show', ['item_id' => $item->id]) }}" class="group block">
                <div class="relative aspect-square mb-3">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" 
                         class="w-full h-full object-cover rounded-xl shadow-sm group-hover:opacity-90 transition">
                    
                    @if($item->orders()->exists())
                        <div class="absolute top-0 left-0 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-tl-xl rounded-br-xl uppercase">Sold</div>
                    @endif
                </div>

                <div class="space-y-1">
                    <h3 class="text-gray-800 font-medium truncate">{{ $item->name }}</h3>
                    <p class="text-xl font-extrabold text-gray-900">¥{{ number_format($item->price) }}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection