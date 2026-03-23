{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

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
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.app')

@section('title', 'larapets: Register')

@section('content')
    @include('partials.navbar')
    <section class="bg-[#0006] p-4 outline rounded-md my-8 md:w-fit w-80 flex flex-col justify-center items-center">
    <h1 class="text-4xl flex gap-2 border-b-2 pb-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-10" fill="currentColor" viewBox="0 0 256 256"><path d="M256,136a8,8,0,0,1-8,8H232v16a8,8,0,0,1-16,0V144H200a8,8,0,0,1,0-16h16V112a8,8,0,0,1,16,0v16h16A8,8,0,0,1,256,136Zm-57.87,58.85a8,8,0,0,1-12.26,10.3C165.75,181.19,138.09,168,108,168s-57.75,13.19-77.87,37.15a8,8,0,0,1-12.25-10.3c14.94-17.78,33.52-30.41,54.17-37.17a68,68,0,1,1,71.9,0C164.6,164.44,183.18,177.07,198.13,194.85ZM108,152a52,52,0,1,0-52-52A52.06,52.06,0,0,0,108,152Z"></path></svg>
        Register
    </h1>
    {{-- Form Resgister --}}
    <form action="{{ route('register')}}" method="POST" class="flex flex-col md:flex-row gap-x-2 mt-8 w-full">
        @csrf
        {{-- First Column --}}
        {{-- Document --}}
        <div class="w-full md:w-80 flex flex-col gap-2">
            <label class="label">Document:</label>
            <input class="input bg-[#0009] outline-1" type="text" name="document" value="{{ old('document')}}" placeholder="750000011">
            @error('document')
                <small class="badge badge-error w-full">{{$message}}</small>
            @enderror
        {{-- Fullname --}}
            <label class="label">Fullname:</label>
            <input class="input bg-[#0009] outline-1" type="text" name="fullname" value="{{ old('fullname')}}" placeholder="Jeremias Springfield">
            @error('fullname')
                <small class="badge badge-error w-full">{{$message}}</small>
            @enderror
        {{-- Gender --}}
            <label class="label">Gender:</label>
            <select name="gender" class="select bg-[#0009] outline-1">
                <option value="">Select..</option>
                <option value="Female" @if(old('gender') == 'Female') selected @endif>
                    Female
                </option>
                <option value="Male" @if(old('gender') == 'Male') selected @endif>
                    Male
                </option>
            </select>
            @error('gender')
                <small class="badge badge-error w-full">{{$message}}</small>
            @enderror
        {{-- BirthDate --}}
            <label class="label">Birthdate:</label>
            <input class="input bg-[#0009] outline-1" type="text" name="birthdate" value="{{ old('birthdate')}}" placeholder="2000-12-25">
            @error('birthdate')
                <small class="badge badge-error w-full">{{$message}}</small>
            @enderror
        </div>
        {{-- Second Column --}}
        <div class="w-full md:w-80 flex flex-col gap-2">
        {{-- Phone --}}
            <label class="label">Phone:</label>
            <input class="input bg-[#0009] outline-1" type="text" name="phone" value="{{ old('phone')}}" placeholder="3200000011">
            @error('phone')
                <small class="badge badge-error w-full">{{$message}}</small>
            @enderror
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
        {{-- Button --}}
        <button class="btn btn-outline w-full mt-2">
            Register
        </button>
        </div>
    </form>
    </section>

@endsection
