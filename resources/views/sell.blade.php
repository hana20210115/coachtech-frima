@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-12 px-4 sm:px-6">
    <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">商品の出品</h2>

    <form action="{{ route('item.store') }}" method="POST" novalidate enctype="multipart/form-data">
        @csrf

        <div class="mb-12">
            <label class="block text-xl font-bold mb-6">商品画像</label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-12 flex flex-col items-center justify-center bg-gray-50 h-64">
                <label class="cursor-pointer bg-white border-2 border-red-500 text-red-500 px-8 py-2 rounded-md font-bold hover:bg-red-50 transition">
                    画像を選択する
                    <input type="file" name="image" class="hidden">
                </label>
            </div>
            @error('image')
                <p class="text-red-500 text-sm mt-2 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <h3 class="text-2xl font-bold border-b-2 border-gray-200 pb-2 mb-8">商品の詳細</h3>

        <div class="mb-10">
            <label class="block text-lg font-bold mb-4 text-gray-700">カテゴリー</label>
            <div class="flex flex-wrap gap-x-4 gap-y-3">
                @foreach($categories as $category)
                    <label class="cursor-pointer group">
                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" 
                            class="hidden peer" {{ is_array(old('category_ids')) && in_array($category->id, old('category_ids')) ? 'checked' : '' }}>
                        <span class="px-5 py-1.5 rounded-full border-2 border-red-400 text-red-400 text-sm font-medium transition-colors
                            peer-checked:bg-red-400 peer-checked:text-white group-hover:bg-red-50">
                            {{ $category->name }}
                        </span>
                    </label>
                @endforeach
            </div>
            @error('category_ids')
                <p class="text-red-500 text-sm mt-2 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-12">
            <label for="condition_id" class="block text-lg font-bold mb-4 text-gray-700">商品の状態</label>
            <div class="relative">
                <select name="condition_id" id="condition_id" class="w-full border-2 border-gray-300 rounded-lg p-4 appearance-none focus:outline-none focus:border-gray-500 bg-white">
                    <option value="" disabled selected>選択してください</option>
                    @foreach($conditions as $condition)
                        <option value="{{ $condition->id }}" {{ old('condition_id') == $condition->id ? 'selected' : '' }}>
                            {{ $condition->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-600">
                    <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
            @error('condition_id')
                <p class="text-red-500 text-sm mt-2 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <h3 class="text-2xl font-bold border-b-2 border-gray-200 pb-2 mb-8">商品名と説明</h3>

        <div class="mb-10">
            <label for="name" class="block text-lg font-bold mb-4 text-gray-700">商品名</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="w-full border-2 border-gray-300 rounded-lg p-4 focus:outline-none focus:border-gray-500">
            @error('name')
                <p class="text-red-500 text-sm mt-2 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-10">
            <label for="brand" class="block text-lg font-bold mb-4 text-gray-700">ブランド名</label>
            <input type="text" name="brand" id="brand" value="{{ old('brand') }}"
                class="w-full border-2 border-gray-300 rounded-lg p-4 focus:outline-none focus:border-gray-500">
            @error('brand')
                <p class="text-red-500 text-sm mt-2 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-10">
            <label for="description" class="block text-lg font-bold mb-4 text-gray-700">商品の説明</label>
            <textarea name="description" id="description" rows="6" 
                class="w-full border-2 border-gray-300 rounded-lg p-4 focus:outline-none focus:border-gray-500">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-2 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-12">
            <label for="price" class="block text-lg font-bold mb-4 text-gray-700">販売価格</label>
            <div class="relative">
                <span class="absolute left-4 top-4 text-xl text-gray-600 font-medium">¥</span>
                <input type="number" name="price" id="price" value="{{ old('price') }}"
                    class="w-full border-2 border-gray-300 rounded-lg p-4 pl-10 focus:outline-none focus:border-gray-500 text-lg">
            </div>
            @error('price')
                <p class="text-red-500 text-sm mt-2 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-red-500 text-white font-bold py-4 rounded-lg text-xl hover:bg-red-600 transition-colors shadow-md">
            出品する
        </button>
    </form>
</div>
@endsection