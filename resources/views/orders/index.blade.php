@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center mb-2">
        <h2 class="text-2xl font-bold text-[#274e3a]">Daftar Pesanan</h2>
        <a href="{{ route('orders.create') }}" class="bg-[#97b9d4] hover:bg-[#7a9cb8] text-[#274e3a] font-semibold px-4 py-2 rounded-lg transition">
            + Buat Pesanan
        </a>
    </div>
    <p class="text-gray-600 mb-4">Kelola pesanan, menu, total harga dan status pesanan pelanggan.</p>



    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
        <table class="w-full text-left text-sm border-collapse">
            <thead class="border-b border-gray-200 text-gray-500">
                <tr>
                    <th class="pb-3 w-12">No</th>
                    <th class="pb-3">Pelanggan</th>
                    <th class="pb-3">Daftar Item Menu</th>
                    <th class="pb-3">Total Harga</th>
                    <th class="pb-3">Status</th>
                    <th class="pb-3 pr-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $index => $order)
                    <tr>
                        <td class="py-3 font-medium text-gray-600 align-top">{{ $index + 1 }}</td>
                        <td class="py-3 font-medium text-gray-800 align-top">{{ $order->customer->name ?? '-' }}</td>
                        <td class="py-3 text-gray-600 align-top">
                            <ul class="list-disc list-inside space-y-0.5 text-xs">
                                @foreach($order->items as $item)
                                    <li>{{ $item->menu->name ?? '-' }} <span class="font-semibold text-gray-800">(x{{ $item->quantity }})</span></li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="py-3 font-medium text-gray-800 align-top">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="py-3 align-top">
                            @if($order->status == 'completed')
                                <span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs rounded">Selesai</span>
                            @elseif($order->status == 'pending')
                                <span class="px-2 py-0.5 bg-amber-100 text-amber-700 text-xs rounded">Pending</span>
                            @else
                                <span class="px-2 py-0.5 bg-red-100 text-red-700 text-xs rounded">Batal</span>
                            @endif
                        </td>
                       <td class="py-3 text-center space-x-2 align-top">
                            <a href="{{ route('orders.edit', $order->id) }}" class="inline-flex items-center p-1.5 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-lg transition" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center p-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition" title="Hapus" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-6 text-center text-gray-400">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection