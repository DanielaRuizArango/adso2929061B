{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('layouts.app')

@section('title', 'larapets: Login')

@section('content')
    @include('partials.navbar')
    <section class="bg-[#0006] p-4 outline rounded-md w-90 flex flex-col justify-center items-center">
    <h1 class="text-4xl flex gap-2 border-b-2 pb-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-10" fill="currentColor" viewBox="0 0 256 256"><path d="M208,80H96V56a32,32,0,0,1,32-32c15.37,0,29.2,11,32.16,25.59a8,8,0,0,0,15.68-3.18C171.32,24.15,151.2,8,128,8A48.05,48.05,0,0,0,80,56V80H48A16,16,0,0,0,32,96V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V96A16,16,0,0,0,208,80Zm0,128H48V96H208V208Zm-68-56a12,12,0,1,1-12-12A12,12,0,0,1,140,152Z"></path></svg>
        Login
    </h1>
    <form action="{{ route('login')}}" method="POST" class="flex mt-8 flex-col gap-2 w-full">
        @csrf
        <label class="label">Email:</label>
        <input class="input bg-[#0009] outline-1" type="text" name="email" value="{{ old('email')}}" placeholder="username@mail.com">
        @error('email')
            <small class="badge badge-error w-full">{{$message}}</small>
        @enderror
        <label class="label">Password:</label>
        <input class="input bg-[#0009] outline-1" type="password" name="password" placeholder="yoursecret">
        @error('password')
            <small class="badge badge-error w-full">{{$message}}</small>
        @enderror
        <button class="btn mt-4">Login</button>
        @if (Route::has('password.request'))
            <a class="text-sm border-b-2 w-fit pb-1 mt-4 text-white hover:text-[#fff9]" href="{{ route('password.request') }}">
                Forgot your password?
            </a>
        @endif
    </form>
    </section>

@endsection