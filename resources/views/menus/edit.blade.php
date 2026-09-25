@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-xl shadow-sm">
    <h2 class="text-xl font-bold mb-4">Edit Menu</h2>
    
    <form action="{{ route('menus.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
            <select name="category_id" required class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#f4ff79] outline-none">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $menu->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Menu</label>
            <input type="text" name="name" value="{{ $menu->name }}" required class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#f4ff79] outline-none">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#f4ff79] outline-none">{{ $menu->description }}</textarea>
        </div>

        <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                <input type="number" name="price" value="{{ $menu->price }}" required class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#f4ff79] outline-none">
        </div>
        
        <div class="flex justify-end space-x-2">
            <a href="{{ route('menus.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg">Batal</a>
            <button type="submit" class="px-4 py-2 bg-[#97b9d4] hover:bg-gray-300 text-[#274e3a] rounded-lg">Perbarui</button>
        </div>
    </form>
</div>
@endsection