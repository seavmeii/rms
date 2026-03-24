@extends('layouts.admin')

@section('header', 'Update Order Status')

@section('content')

<div class="bg-white p-6 shadow rounded max-w-lg">

    <h2 class="text-lg font-bold mb-4">Order #{{ $order->id }}</h2>

    <p class="mb-2">Customer: {{ $order->user->name }}</p>
    <p class="mb-4">Total: ${{ number_format($order->total_price,2) }}</p>

    <form action="{{ route('admin.orders.update',$order->id) }}" method="POST">

        @csrf
        @method('PUT')

        <label class="block mb-2 font-semibold">Status</label>

        <select name="status" class="border p-2 w-full mb-4">


            <option value="preparing" {{ $order->status=='preparing'?'selected':'' }}>
                Preparing
            </option>


            <option value="completed" {{ $order->status=='completed'?'selected':'' }}>
                Completed
            </option>

            <option value="cancelled" {{ $order->status=='cancelled'?'selected':'' }}>
                Cancelled
            </option>

        </select>

        

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Update Status
        </button>

    </form>

</div>

@endsection