@extends('layouts.app')

@section('title', $item->name . ' | COACHTECH')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-10">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <div>
            <div class="bg-gray-100 aspect-square rounded-md overflow-hidden flex items-center justify-center">
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
            </div>
        </div>

        <div class="space-y-8">
            <div>
                <h2 class="text-3xl font-bold mb-2">{{ $item->name }}</h2>
                <p class="text-sm text-gray-500 mb-6">{{ $item->brand }}</p>
                <div class="flex items-end gap-2">
                    <span class="text-4xl font-bold">¥{{ number_format($item->price) }}</span>
                    <span class="text-sm text-gray-900 pb-1">(税込)</span>
                </div>
            </div>

            <div class="flex gap-6">
                <div class="flex flex-col items-center">
                    <form action="{{ route('item.like', ['item_id' => $item->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="focus:outline-none">
                            @if(auth()->check() && $item->likes()->where('user_id', auth()->id())->exists())
                                <img src="{{ asset('image/heart-pink.png') }}" class="w-8 h-8 object-contain hover:opacity-80 transition" alt="いいね解除">
                            @else
                                <img src="{{ asset('image/heart.png') }}" class="w-8 h-8 object-contain hover:opacity-80 transition" alt="いいね">
                            @endif
                        </button>
                    </form>
                    <span class="text-sm font-bold mt-1">{{ $item->likes()->count() }}</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="{{ asset('image/comment.png') }}" class="w-8 h-8 object-contain" alt="コメント">
                    <span class="text-sm font-bold mt-1">{{ $item->comments()->count() }}</span>
                </div>
            </div>

            <a href="{{ route('purchase.create', ['item_id' => $item->id]) }}" class="block w-full text-center bg-[#ed6163] hover:bg-red-500 text-white font-bold py-4 rounded transition">
                購入手続きへ
            </a>

            <div>
                <h3 class="text-xl font-bold mb-4">商品説明</h3>
                <p class="text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $item->description }}</p>
            </div>

            <div>
            <h3 class="text-xl font-bold mb-4">商品の情報</h3>


        <div class="flex items-center mb-4">
            <span class="font-bold w-32">カテゴリー</span>
        <div class="flex flex-wrap gap-2">

        
        @foreach($item->categories as $category)
            <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm">
                {{ $category->name }}
            </span>
        @endforeach
        </div>
        </div>


        <div class="flex items-center mb-4">
            <span class="font-bold w-32">ブランド</span>
            <span class="text-gray-700">
        
        @if($item->brand)
            {{ $item->brand }}
        @else
            なし
        @endif
            </span>
        </div>


            <div class="flex items-center mb-8">
                <span class="font-bold w-32">商品の状態</span>
                <span class="text-gray-700">{{ $item->condition->name ?? '目立った傷や汚れなし' }}</span>
            </div>            
        </div>


            <div class="pt-8">
                <h3 class="text-xl font-bold mb-6">コメント({{ $item->comments()->count() }})</h3>
                @foreach($item->comments as $comment)
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 bg-gray-300 rounded-full overflow-hidden">
                                @if($comment->user->profile_image)

                                    <img src="{{ asset('storage/' . $comment->user->profile_image) }}" class="w-full h-full object-cover">

                                @endif
                            </div>
                            <span class="font-bold">{{ $comment->user->name }}</span>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-md text-gray-700">
                            {{ $comment->comment }}
                        </div>
                    </div>
                @endforeach

                <form action="{{ route('comment.store', ['item_id' => $item->id]) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="comment" class="block font-bold mb-2">商品へのコメント</label>

                        <textarea id="comment" name="comment" rows="5" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:border-gray-500">{{ old('comment') }}</textarea>
                        
                        @error('comment')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                    </div>
                    <button type="submit" class="w-full bg-[#ed6163] hover:bg-red-500 text-white font-bold py-4 rounded transition">
                        コメントを送信する
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection