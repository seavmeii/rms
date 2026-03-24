@extends('layouts.admin')

@section('header')
    Add New Category
@endsection

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Category Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full border rounded p-2 mt-1"
                   placeholder="Enter category name">
            @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
            Save Category
        </button>
        <a href="{{ route('admin.categories.index') }}" 
           class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
            Cancel
        </a>
    </form>
</div>
@endsection