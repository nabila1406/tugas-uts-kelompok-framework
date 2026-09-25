@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <h2 class="text-2xl font-bold mb-3">Management System Cafe</h2>
    <p class="text-gray-600">Selamat datang di sistem management cafe.kita!!
        Tempat ringkasan informasi cafe seperti pesanan, pendapatan, menu, dan pelanggan.
    </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
            <p class="text-xs text-gray-500 font-medium">Total Pendapatan</p>
            <h3 class="text-xl font-bold text-[#274e3a] mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
        </div>

        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
            <p class="text-xs text-gray-500 font-medium">Total Pesanan</p>
            <h3 class="text-xl font-bold text-[#274e3a] mt-1">{{ $totalOrders }} Pesanan</h3>
        </div>

        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
            <p class="text-xs text-gray-500 font-medium">Total Menu & Pelanggan</p>
            <h3 class="text-xl font-bold text-[#274e3a] mt-1">{{ $totalMenus }} Menu | {{ $totalCustomers }} Pelanggan</h3>
        </div>
    </div>

    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-[#274e3a]">Pesanan Terbaru</h3>
            <a href="{{ route('orders.index') }}" class="text-sm text-amber-600 hover:underline">Lihat Semua</a>
        </div>

        <table class="w-full text-left text-sm border-collapse">
            <thead class="border-b border-gray-200 text-gray-500">
                <tr>
                    <th class="pb-2">Pelanggan</th>
                    <th class="pb-2">Daftar Item Menu</th>
                    <th class="pb-2">Total Harga</th>
                    <th class="pb-2">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($recentOrders as $order)
                    <tr>
                        <td class="py-2.5 font-medium text-gray-800 align-top">{{ $order->customer->name ?? '-' }}</td>
                        <td class="py-2.5 text-gray-600 align-top">
                            <ul class="list-disc list-inside space-y-0.5 text-xs">
                                @foreach($order->items as $item)
                                    <li>{{ $item->menu->name ?? '-' }} <span class="font-semibold text-gray-800">(x{{ $item->quantity }})</span></li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="py-2.5 font-medium text-gray-800 align-top">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="py-2.5 align-top">
                            @if($order->status == 'completed')
                                <span class="px-2 py-0.5 bg-green-100 text-green-700 text-xs rounded">Selesai</span>
                            @elseif($order->status == 'pending')
                                <span class="px-2 py-0.5 bg-amber-100 text-amber-700 text-xs rounded">Pending</span>
                            @else
                                <span class="px-2 py-0.5 bg-red-100 text-red-700 text-xs rounded">Batal</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-400">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection