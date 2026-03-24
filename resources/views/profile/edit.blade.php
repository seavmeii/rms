@extends('layouts.profile')

@section('header', 'Edit Profile')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    @if(session('success'))
        <div class="p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Update Profile -->
    <div class="bg-white shadow sm:rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Profile Information</h2>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="name" class="block font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                       class="mt-1 block w-full border rounded p-2" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                       class="mt-1 block w-full border rounded p-2" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Save Changes
            </button>
        </form>
    </div>

    <!-- Update Password -->
    <div class="bg-white shadow sm:rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Change Password</h2>
        <form method="POST" action="{{ route('profile.updatePassword') }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="current_password" class="block font-medium text-gray-700">Current Password</label>
                <input type="password" name="current_password" id="current_password"
                       class="mt-1 block w-full border rounded p-2" required>
                @error('current_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block font-medium text-gray-700">New Password</label>
                <input type="password" name="password" id="password"
                       class="mt-1 block w-full border rounded p-2" required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block font-medium text-gray-700">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="mt-1 block w-full border rounded p-2" required>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Update Password
            </button>
        </form>
    </div>

    <!-- Delete Account -->
    <div class="bg-white shadow sm:rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4 text-red-600">Delete Account</h2>
        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <div class="mb-4">
                <label for="password_delete" class="block font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password" id="password_delete"
                       class="mt-1 block w-full border rounded p-2" required>
            </div>

            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Delete Account
            </button>
        </form>
    </div>

</div>
@endsection