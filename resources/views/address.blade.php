@extends('layouts.app')

@section('title', '住所の変更')

@section('content')
<div class="max-w-3xl mx-auto py-16 px-4">
    
    <h1 class="text-2xl font-bold text-center mb-12">住所の変更</h1>

    
    <form action="{{ route('purchase.address.update', $item->id) }}" method="POST" class="max-w-xl mx-auto space-y-8">
        @csrf
        
        
        <div>
            <label for="postcode" class="block font-bold text-gray-900 mb-2">郵便番号</label>
            <input type="text" name="postcode" id="postcode" 
                   value="{{ old('postcode', $user->postcode) }}" 
                   class="w-full border border-gray-400 rounded-sm p-3 focus:outline-none focus:border-gray-600">
        </div>

        
        <div>
            <label for="address" class="block font-bold text-gray-900 mb-2">住所</label>
            <input type="text" name="address" id="address" 
                   value="{{ old('address', $user->address) }}" 
                   class="w-full border border-gray-400 rounded-sm p-3 focus:outline-none focus:border-gray-600">
        </div>

        
        <div>
            <label for="building" class="block font-bold text-gray-900 mb-2">建物名</label>
            <input type="text" name="building" id="building" 
                   value="{{ old('building', $user->building) }}" 
                   class="w-full border border-gray-400 rounded-sm p-3 focus:outline-none focus:border-gray-600">
        </div>

       
        <div class="pt-6">
            <button type="submit" class="w-full bg-[#FF5555] text-white font-bold py-4 rounded hover:bg-red-600 transition">
                更新する
            </button>
        </div>
    </form>
</div>
@endsection