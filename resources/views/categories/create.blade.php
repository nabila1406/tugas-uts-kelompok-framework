@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-sm">
    <h2 class="text-xl font-bold mb-4">Tambah Kategori Baru</h2>
    
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
            <input type="text" name="name" required class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#f4ff79] outline-none">
        </div>
        
        <div class="flex justify-end space-x-2">
            <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg">Batal</a>
            <button type="submit" class="px-4 py-2 bg-[#97b9d4] hover:bg-gray-300 text-[#274e3a] rounded-lg">Simpan</button>
        </div>
    </form>
</div>
@endsection