@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-2">
    <h2 class="text-2xl font-bold">Daftar Kategori</h2>
    <a href="{{ route('categories.create') }}" class="bg-[#97b9d4] hover:bg-[#7a9cb8] text-[#274e3a] font-semibold px-4 py-2 rounded-lg transition">+ Tambah Kategori</a>
</div>
<p class="text-gray-600 mb-4">Kelola kategori menu cafe.</p>


<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 border-b border-gray-200 text-gray-600 text-sm">
            <tr>
                <th class="p-4 pl-8">No</th>
                <th class="p-4">Nama Kategori</th>
                <th class="p-4 pr-6 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($categories as $index => $category)
                <tr class="hover:bg-slate-50">
                    <td class="p-4 pl-8 font-medium">{{ $index + 1 }}</td>
                    <td class="p-4">{{ $category->name }}</td>
                    <td class="py-3 text-center space-x-2 align-top">
                        <a href="{{ route('categories.edit', $category->id) }}" class="inline-flex items-center p-1.5 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-lg transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center p-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition" title="Hapus" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-400">Belum ada data kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection