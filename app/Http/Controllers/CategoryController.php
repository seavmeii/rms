<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::paginate(10); // paginate for admin view
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category added successfully!');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully!');
    }
////delete////
public function destroy($id) // ← use $id instead of Category $category
{
    $category = \App\Models\Category::find($id); // manually find
    if (!$category) {
        return redirect()->route('admin.categories.index')
            ->with('error', 'Category not found!');
    }

    // Optional: prevent deletion if it has foods
    if ($category->foods()->exists()) {
        return redirect()->route('admin.categories.index')
            ->with('error', 'Cannot delete category with menu items!');
    }

    $category->delete();

    return redirect()->route('admin.categories.index')
        ->with('success', 'Category deleted successfully!');
}
}