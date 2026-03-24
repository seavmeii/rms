@extends('layouts.admin')

@section('content')
<div class="flex justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-700">Menu Items</h2>
    <a href="{{ route('admin.foods.create') }}"
        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
        + Add Menu
    </a>
</div>

{{-- Success Message --}}
@if(session('success'))
<div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
    {{ session('success') }}
</div>
@endif

{{-- Table --}}
<div class="overflow-x-auto bg-white rounded shadow">
    <table class="w-full table-auto border-collapse">
        <thead class="bg-gray-100">
            <tr class="text-left">
                <th class="p-3">#</th>
                <th class="p-3">Image</th>
                <th class="p-3">Name</th>
                <th class="p-3">Price</th>
                <th class="p-3">Category</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($foods as $food)
            <tr class="border-t hover:bg-gray-50">
                <td class="p-3">{{ $loop->iteration + ($foods->currentPage() - 1) * $foods->perPage() }}</td>

                {{-- Image --}}
                <td class="p-3">
                    @if($food->image)
                    <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->name }}" class="h-48 w-48 object-cover rounded">
                    @else
                    <div class="h-16 w-16 bg-gray-200 flex items-center justify-center rounded text-gray-400 text-xs">
                        No Image
                    </div>
                    @endif
                </td>

                <td class="p-3">{{ $food->name }}</td>
                <td class="p-3">${{ number_format($food->price, 2) }}</td>
                <td class="p-3">{{ $food->category->name ?? '-' }}</td>
               <td class="p-3">
    <div class="flex gap-2 justify-center">

        <!-- Edit -->
        <a href="{{ route('admin.foods.edit', $food->id) }}"
            class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
            Edit
        </a>

        <!-- Delete -->
        <form action="{{ route('admin.foods.destroy', $food->id) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this item?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                Delete
            </button>
        </form>

    </div>
</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-3 text-center text-gray-500">No menu items found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<!-- Pagination -->
<div class="mt-6">
    {{ $foods->links() }}
</div>
@endsection