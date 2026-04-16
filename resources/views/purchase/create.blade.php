@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 mt-8">
    <div class="flex flex-col md:flex-row gap-10">
        
        
        <div class="w-full md:w-1/2">
            <div class="flex items-center gap-6 mb-8 border-b pb-8">
                <img src="{{ asset('storage/' . $item->image) }}" class="w-40 h-40 object-cover rounded bg-gray-200 shadow-sm" alt="{{ $item->name }}">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $item->name }}</h2>
                    <p class="text-xl mt-2 font-semibold text-gray-900">
                        <span class="text-sm mr-1">¥</span>
                        {{ number_format($item->price) }}
                    </p>
                </div>
            </div>
        </div>

        
        <div class="w-full md:w-1/2">
            
            <form action="{{ route('purchase.store', ['item_id' => $item->id]) }}" method="POST" class="bg-white p-6 rounded-lg border border-gray-300 shadow-sm">
                @csrf
                
                
                <div class="mb-8">
                    <h3 class="font-bold border-b-2 border-gray-100 pb-2 mb-4 text-gray-700">支払い方法</h3>
                    <select name="payment_method" class="w-full border-gray-300 rounded-md focus:ring-[#ed6163] focus:border-[#ed6163]">
                        <option value="" hidden>選択してください</option>
                        
                        <option value="konbini" {{ old('payment_method') == 'konbini' ? 'selected' : '' }}>コンビニ払い</option>
                        <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>カード支払い</option>
                    </select>
                    
                    @error('payment_method')
                        <p class="text-red-500 text-sm mt-2 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                
                <div class="mb-10">
                    <div class="flex justify-between items-center border-b-2 border-gray-100 pb-2 mb-4">
                        <h3 class="font-bold text-gray-700">配送先</h3>                        
                        <a href="{{ route('profile.edit') }}" class="text-blue-500 text-sm font-bold hover:underline">変更する</a>
                    </div>
                    <div class="text-gray-600 space-y-1">
                        
                        @if(Auth::user()->postal_code && Auth::user()->address)
                            <p>〒{{ Auth::user()->postal_code }}</p>
                            <p>{{ Auth::user()->address }}</p>
                            @if(Auth::user()->building)
                                <p>{{ Auth::user()->building }}</p>
                            @endif
                        @else
                            <p class="text-red-500 text-sm font-bold">配送先住所が登録されていません。</p>
                        @endif
                    </div>
                </div>

                
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-8">
                    <div class="flex justify-between items-center mb-4 text-gray-600">
                        <span class="font-bold">商品代金</span>
                        <span class="font-bold">¥ {{ number_format($item->price) }}</span>
                    </div>
                    <div class="flex justify-between items-center border-t border-gray-200 pt-4">
                        <span class="font-bold text-gray-800">支払い金額</span>
                        <span class="font-bold text-2xl text-[#ed6163]">¥ {{ number_format($item->price) }}</span>
                    </div>
                </div>

                
                <button type="submit" class="w-full bg-[#ed6163] hover:bg-red-500 text-white font-bold py-4 rounded-md transition duration-200 shadow-md">
                    購入する
                </button>
            </form>
        </div>

    </div>
</div>
@endsection