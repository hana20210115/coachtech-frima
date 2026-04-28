@extends('layouts.app')

@section('title', '購入手続き')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <form action="{{ route('purchase.store', $item->id) }}" method="POST" novalidate class="flex flex-col lg:flex-row gap-12 items-start">
        @csrf
        
        <div class="flex-1 space-y-12">
            <div class="flex items-start gap-8 pb-10 border-b border-gray-300">
                <div class="w-40 aspect-square shrink-0 bg-gray-100">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                </div>
                <div class="space-y-4 text-gray-900">
                    <h1 class="text-3xl font-bold">{{ $item->name }}</h1>
                    <p class="text-3xl font-bold">¥ {{ number_format($item->price) }}</p>
                </div>
            </div>

            <div class="space-y-4 pb-10 border-b border-gray-300">
                <h2 class="text-xl font-bold text-gray-900">支払い方法</h2>
                <div class="relative max-w-sm">
                    <select name="payment_method"
                            class="w-full h-12 px-4 py-2 border {{ $errors->has('payment_method') ? 'border-red-500' : 'border-gray-300' }} bg-white rounded text-gray-700 text-sm appearance-none focus:outline-none">
                        <option value="" disabled selected>選択してください</option>
                        <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>カード支払い</option>
                        <option value="konbini" {{ old('payment_method') == 'konbini' ? 'selected' : '' }}>コンビニ支払い</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
                @error('payment_method')
                    <p class="text-red-500 text-sm mt-1 font-bold">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-4 pb-10 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900">配送先</h2>
                    <a href="{{ route('purchase.address.edit', $item->id) }}" class="text-sm text-blue-600 font-bold hover:underline">
                        変更する
                    </a>
                </div>
                <div class="space-y-1 text-gray-700">
                    <p>〒 {{ $address['postcode'] ?? '未登録' }}</p>
                    <p>{{ $address['address'] ?? '住所が登録されていません' }} {{ $address['building'] ?? '' }}</p>
                </div>
                
                <input type="hidden" name="address_id" value="{{ auth()->user()->profile->id ?? '' }}">
                
                @error('address_id')
                    <p class="text-red-500 text-sm mt-1 font-bold">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="w-full lg:w-96 space-y-8">
            <div class="border border-gray-300 p-8 space-y-6">
                <div class="flex items-center justify-between text-lg">
                    <span class="text-gray-600">商品代金</span>
                    <span class="text-gray-900 font-bold">¥ {{ number_format($item->price) }}</span>
                </div>
            </div>

            <button type="submit" class="w-full bg-[#FF5555] hover:bg-red-600 text-white font-bold py-4 rounded transition">
                購入する
            </button>
        </div>
    </form>
</div>
@endsection