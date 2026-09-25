@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-2">
    <h2 class="text-2xl font-bold text-[#274e3a]">Daftar Menu</h2>
    <a href="{{ route('menus.create') }}" class="bg-[#97b9d4] hover:bg-[#7a9cb8] text-[#274e3a] font-semibold  px-4 py-2 rounded-lg transition">+ Tambah Menu</a>
</div>
<p class="text-gray-600 mb-4">Kelola daftar menu, kategori, deskripsi menu, dan harga.</p>



<div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 border-b border-gray-200 text-gray-600 text-sm">
            <tr>
                <th class="p-4 w-12">No</th>
                <th class="p-4">Nama Menu</th>
                <th class="p-4">Kategori</th>
                <th class="p-4">Deskripsi</th>
                <th class="p-4">Harga</th>
                <th class="p-4 pr-6 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm">
            @forelse($menus as $index => $menu)
                <tr class="hover:bg-slate-50 transition">
                    <td class="p-4 font-medium text-gray-600">{{ $index + 1 }}</td>
                    <td class="p-4 font-semibold text-gray-900">{{ $menu->name }}</td>
                    <td class="p-4">
                        <span class="px-2.5 py-1 bg-amber-100 text-amber-800 text-xs rounded-full font-medium">
                            {{ $menu->category->name ?? '-' }}
                        </span>
                    </td>
                    <td class="p-4 text-gray-500">{{ $menu->description ?? '-' }}</td>
                    <td class="p-4 font-medium text-gray-800">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                    <td class="py-3 text-center space-x-2 align-top">
                        <a href="{{ route('menus.edit', $menu->id) }}" class="inline-flex items-center p-1.5 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-lg transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center p-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition" title="Hapus" onclick="return confirm('Yakin ingin menghapus menu ini?')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-400">Belum ada data menu.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection