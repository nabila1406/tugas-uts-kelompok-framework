@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-xl shadow-sm">
    <h2 class="text-xl font-bold mb-4">Edit Pesanan</h2>
    
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Pelanggan</label>
            <select name="customer_id" required class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#f4ff79] outline-none">
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $order->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Ganti Bagian Menu & Jumlah dengan 3 Slot Ini -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Daftar Menu (Isi menu yang dipesan saja)</label>
            <div class="space-y-3">
                @for ($i = 0; $i < 3; $i++)
                    @php
                        $existingItem = $order->items[$i] ?? null;
                    @endphp
                    <div class="flex gap-2 items-center">
                        <select name="items[{{ $i }}][menu_id]" class="flex-1 border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#f4ff79] outline-none">
                            <option value="">-- Pilih Menu {{ $i + 1 }} {{ $i == 0 ? '(Wajib)' : '(Opsional)' }} --</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}" {{ (optional($existingItem)->menu_id == $menu->id) ? 'selected' : '' }}>
                                    {{ $menu->name }} (Rp {{ number_format($menu->price, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                        <input type="number" name="items[{{ $i }}][quantity]" value="{{ optional($existingItem)->quantity ?? 1 }}" min="1" class="w-24 border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-amber-500 outline-none" placeholder="Qty">
                    </div>
                @endfor
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Status Pesanan</label>
            <select name="status" required class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#f4ff79] outline-none">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Batal</option>
            </select>
        </div>
        
        <div class="flex justify-end space-x-2">
            <a href="{{ route('orders.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg">Batal</a>
            <button type="submit" class="px-4 py-2 bg-[#97b9d4] hover:bg-gray-300 text-[#274e3a] rounded-lg">Perbarui Pesanan</button>
        </div>
    </form>
</div>
@endsection