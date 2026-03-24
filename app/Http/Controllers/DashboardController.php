<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Admin dashboard
        if ($user->role === 'admin') {
            $totalOrders = Order::count();
            $totalMenuItems = Food::count();
            $totalCustomers = User::where('role', 'customer')->count();
            $recentOrders = Order::latest()->take(5)->get();

            return view('admin.dashboard.index', compact(
                'totalOrders', 'totalMenuItems', 'totalCustomers', 'recentOrders'
            ));
        }

        // Customer menu
        $foods = Food::with('category')->paginate(8);
        $categories = Category::all();

        return view('customer.dashboard.index', compact('foods', 'categories'));
    }

}