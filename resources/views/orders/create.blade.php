@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Buat Pesanan Baru</h2>

    <form action="{{ route('orders.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Pelanggan</label>
            <select name="customer_id" required class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#f4ff79] outline-none">
                <option value="">-- Pilih Pelanggan --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

       <div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Daftar Menu (Isi menu yang dipesan saja)</label>
    <div class="space-y-3">
        @for ($i = 0; $i < 3; $i++)
            <div class="flex gap-2 items-center">
                <select name="items[{{ $i }}][menu_id]" required class="flex-1 border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#f4ff79] outline-none">
                    <option value="">-- Pilih Menu {{ $i + 1 }} {{ $i == 0 ? '(Wajib)' : '(Opsional)' }} --</option>
                    @foreach($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->name }} (Rp {{ number_format($menu->price, 0, ',', '.') }})</option>
                    @endforeach
                </select>
                <input type="number" name="items[{{ $i }}][quantity]" value="1" min="1" required class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#f4ff79] outline-none" placeholder="Qty">
            </div>
        @endfor
    </div>
</div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status Pesanan</label>
            <select name="status" required class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-[#f4ff79] outline-none">
                <option value="pending">Pending</option>
                <option value="completed">Selesai</option>
                <option value="cancelled">Batal</option>
            </select>
        </div>

        <div class="flex justify-end space-x-3 pt-4 border-t">
            <a href="{{ route('orders.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg">Batal</a>
            <button type="submit" class="px-5 py-2 bg-[#97b9d4] hover:bg-gray-300 text-[#274e3a] rounded-lg">Simpan Pesanan</button>
        </div>
    </form>
</div>
@endsection