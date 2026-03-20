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