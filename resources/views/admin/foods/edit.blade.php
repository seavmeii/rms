@extends('layouts.admin')

@section('header', 'Edit Menu Item')

@section('content')

<div class="bg-white p-6 rounded shadow max-w-xl">

    <form action="{{ route('admin.foods.update',$food->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Food Name</label>
            <input type="text" name="name"
                value="{{ $food->name }}"
                class="w-full border rounded p-2 mt-1">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Price</label>
            <input type="number" name="price"
                value="{{ $food->price }}"
                class="w-full border rounded p-2 mt-1">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Category</label>
            <select name="category_id"
                class="w-full border rounded p-2 mt-1">

                @foreach($categories as $category)

                <option value="{{ $category->id }}"
                    {{ $food->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>

                @endforeach

            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Image</label>

            @if($food->image)
            <img src="{{ asset('storage/'.$food->image) }}"
                class="w-24 mb-2 rounded">
            @endif

            <input type="file" name="image">
        </div>

        <div class="flex gap-3">
            <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Update
            </button>

            <a href="{{ route('admin.foods.index') }}"
                class="px-4 py-2 bg-gray-400 text-white rounded">
                Cancel
            </a>
        </div>

    </form>

</div>

@endsection