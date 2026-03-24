@extends('layouts.admin')

@section('header')
Categories
@endsection

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-bold text-gray-700">All Categories</h2>
    <a href="{{ route('admin.categories.create') }}"
        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
        + Add Category
    </a>
</div>

@if(session('success'))
<div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
    {{ session('error') }}
</div>
@endif

<table class="w-full bg-white rounded shadow overflow-hidden">
    <thead class="bg-gray-100 text-gray-700">
        <tr>
            <th class="px-4 py-2 text-left">#</th>
            <th class="px-4 py-2 text-left">Name</th>
            <th class="px-4 py-2 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr class="border-b">
            <td class="px-4 py-2">{{ $loop->iteration }}</td>
            <td class="px-4 py-2">{{ $category->name }}</td>
            <td class="px-4 py-2 flex gap-2">
                <a href="{{ route('admin.categories.edit', $category->id) }}"
                    class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Edit
                </a>
              <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
        Delete
    </button>
</form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $categories->links() }}
</div>
@endsection