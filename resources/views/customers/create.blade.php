@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-xl shadow-sm">
    <h2 class="text-xl font-bold mb-4">Tambah Pelanggan Baru</h2>
    
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pelanggan</label>
            <input type="text" name="name" required class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#f4ff79] outline-none">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">No. HP / WhatsApp</label>
            <input type="text" name="phone" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#f4ff79] outline-none">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#f4ff79] outline-none">
        </div>
        
        <div class="flex justify-end space-x-2">
            <a href="{{ route('customers.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg">Batal</a>
            <button type="submit" class="px-4 py-2 bg-[#97b9d4] hover:bg-gray-300 text-[#274e3a] rounded-lg">Simpan</button>
        </div>
    </form>
</div>
@endsection