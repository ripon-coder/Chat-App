@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Profile Information</h2>
        <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
            Update your account's profile information and email address.
        </p>

        {{-- Name --}}
        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
            <input type="text" id="name" name="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <p class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" id="email" name="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <p class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-300">
                    Your email address is unverified.
                    <button form="send-verification"
                        class="underline text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Click here to re-send the verification email.
                    </button>
                </p>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        A new verification link has been sent to your email address.
                    </p>
                @endif
            @endif
        </div>

        {{-- Save Button --}}
        <div class="flex items-center gap-4">
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Save
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-gray-600 dark:text-gray-300">
                   Saved.
                </p>
            @endif
        </div>
    </form>
</div>
@endsection
