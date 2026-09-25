<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\Menu;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'items.menu'])->oldest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        $menus = Menu::all();
        return view('orders.create', compact('customers', 'menus'));
    }

    public function store(Request $request)
    {
        $validItems = array_filter($request->input('items', []), function ($item) {
            return !empty($item['menu_id']);
        });

        if (empty($validItems)) {
            return back()->withErrors(['items' => 'Pilih minimal satu menu.'])->withInput();
        }

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status'      => 'required|in:pending,completed,cancelled',
        ]);

        $order = Order::create([
            'customer_id' => $request->customer_id,
            'total_price' => 0,
            'status'      => $request->status,
        ]);

        $totalPrice = 0;

        foreach ($validItems as $item) {
            $menu = Menu::findOrFail($item['menu_id']);
            $quantity = max(1, (int) $item['quantity']);
            $subtotal = $menu->price * $quantity;
            $totalPrice += $subtotal;

            OrderItem::create([
                'order_id' => $order->id,
                'menu_id'  => $menu->id,
                'quantity' => $quantity,
                'price'    => $menu->price,
                'subtotal' => $subtotal,
            ]);
        }

        $order->update(['total_price' => $totalPrice]);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function edit(Order $order)
    {
        $order->load('items.menu');
        $customers = Customer::all();
        $menus = Menu::all();
        return view('orders.edit', compact('order', 'customers', 'menus'));
    }

    public function update(Request $request, Order $order)
    {
        $validItems = array_filter($request->input('items', []), function ($item) {
            return !empty($item['menu_id']);
        });

        if (empty($validItems)) {
            return back()->withErrors(['items' => 'Pilih minimal satu menu.'])->withInput();
        }

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status'      => 'required|in:pending,completed,cancelled',
        ]);

        $order->items()->delete();

        $totalPrice = 0;

        foreach ($validItems as $item) {
            $menu = Menu::findOrFail($item['menu_id']);
            $quantity = max(1, (int) $item['quantity']);
            $subtotal = $menu->price * $quantity;
            $totalPrice += $subtotal;

            OrderItem::create([
                'order_id' => $order->id,
                'menu_id'  => $menu->id,
                'quantity' => $quantity,
                'price'    => $menu->price,
                'subtotal' => $subtotal,
            ]);
        }

        $order->update([
            'customer_id' => $request->customer_id,
            'total_price' => $totalPrice,
            'status'      => $request->status,
        ]);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus!');
    }
}