{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.app')

@section('title', 'larapets: Reset Password')

@section('content')
    <section class="bg-[#0006] p-4 outline rounded-md my-8 md:w-fit w-96 flex flex-col justify-center items-center">
    <h1 class="text-4xl flex gap-2 border-b-2 pb-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-10" fill="currentColor" viewBox="0 0 256 256"><path d="M48,56V200a8,8,0,0,1-16,0V56a8,8,0,0,1,16,0Zm92,54.5L120,117V96a8,8,0,0,0-16,0v21L84,110.5a8,8,0,0,0-5,15.22l20,6.49-12.34,17a8,8,0,1,0,12.94,9.4l12.34-17,12.34,17a8,8,0,1,0,12.94-9.4l-12.34-17,20-6.49A8,8,0,0,0,140,110.5ZM246,115.64A8,8,0,0,0,236,110.5L216,117V96a8,8,0,0,0-16,0v21l-20-6.49a8,8,0,0,0-4.95,15.22l20,6.49-12.34,17a8,8,0,1,0,12.94,9.4l12.34-17,12.34,17a8,8,0,1,0,12.94-9.4l-12.34-17,20-6.49A8,8,0,0,0,246,115.64Z"></path></svg>
        Reset Password
    </h1>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        {{-- Email --}}
            <label class="label">Email:</label>
            <input class="input bg-[#0009] outline-1" type="text" name="email" value="{{ old('email')}}" placeholder="jeremias@mail.com">
            @error('email')
                <small class="badge badge-error w-full">{{$message}}</small>
            @enderror
        {{-- Password --}}
            <label class="label">Password:</label>
            <input class="input bg-[#0009] outline-1" type="password" name="password" placeholder="yoursecret">
            @error('password')
                <small class="badge badge-error w-full">{{$message}}</small>
            @enderror
        {{-- Password Confirmation --}}
            <label class="label">Password Confirmation:</label>
            <input class="input bg-[#0009] outline-1" type="password" name="password_confirmation" placeholder="yoursecretagain">
            @error('password')
                <small class="badge badge-error w-full">{{$message}}</small>
            @enderror
            {{-- Button --}}
        <button class="btn btn-outline w-full mt-2">
            Reset password
        </button>
    </form>
    </section>
@endsection