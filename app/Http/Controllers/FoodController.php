<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FoodController extends Controller
{
    // ------------------------
    // Customer: Show Menu
    // ------------------------
    public function index()
    {
        
        $foods = Food::paginate(9);
        $categories = Category::all();

        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('admin.foods.index', compact('foods', 'categories'));
        }

        return view('customer.foods.index', compact('foods', 'categories'));
    }

    // Filter foods by category
public function filterByCategory($categoryId)
{
    $foods = Food::where('category_id', $categoryId)->paginate(9);
    $categories = Category::all();

    if (Auth::check() && Auth::user()->role === 'admin') {
        return view('admin.foods.index', compact('foods', 'categories'));
    }

    return view('customer.foods.index', compact('foods', 'categories'));
}


    public function create()
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $categories = Category::all();
        return view('admin.foods.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('name', 'price', 'category_id', 'description');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('foods', 'public');
        }

        Food::create($data);

        return redirect()->route('admin.foods.index')
            ->with('success', 'Food item added successfully!');
    }

    public function edit(Food $food)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $categories = Category::all();
        return view('admin.foods.edit', compact('food', 'categories'));
    }

    public function update(Request $request, Food $food)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('name', 'price', 'category_id', 'description');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('foods', 'public');
        }

        $food->update($data);

        return redirect()->route('admin.foods.index')
            ->with('success', 'Food item updated successfully!');
    }

    public function destroy(Food $food)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $food->delete();

        return redirect()->route('admin.foods.index')
            ->with('success', 'Food item deleted successfully!');
    }
}