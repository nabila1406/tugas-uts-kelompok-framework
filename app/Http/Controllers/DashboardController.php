<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use App\Models\Customer;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');
        
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $totalMenus = Menu::count();
        $totalCustomers = Customer::count();


       $recentOrders = Order::with(['customer', 'items.menu'])->latest()->take(5)->get();
       
        return view('dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'totalMenus',
            'totalCustomers',
            'recentOrders'
        ));
    }
}