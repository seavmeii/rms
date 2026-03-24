@extends('layouts.admin')

@section('header', 'Add Menu Item')

@section('content')

<div class="bg-white p-6 rounded shadow max-w-xl">

    <form action="{{ route('admin.foods.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Food Name</label>
            <input type="text" name="name"
                class="w-full border rounded p-2 mt-1">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Price</label>
            <input type="number" name="price"
                class="w-full border rounded p-2 mt-1">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Category</label>
            <select name="category_id"
                class="w-full border rounded p-2 mt-1">
                @foreach($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Image</label>
            <input type="file" name="image" class="mt-1">
        </div>

        <div class="flex gap-3">
            <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                Save
            </button>

            <a href="{{ route('admin.foods.index') }}"
                class="px-4 py-2 bg-gray-400 text-white rounded">
                Cancel
            </a>
        </div>

    </form>

</div>

@endsection