@extends('layouts.app')

@section('title', 'Larapets: Show User')

@section('content')
    @include('partials.navbar')
    
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
            <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216ZM156,128a12,12,0,1,1-12-12A12,12,0,0,1,156,128Zm-40,0a12,12,0,1,1-12-12A12,12,0,0,1,116,128Zm68,32a4,4,0,0,1,0,8H72a4,4,0,0,1,0-8,40,40,0,0,1,80,0Z"></path>
        </svg>
        Show User
    </h1>

    {{-- Breadcrumbs --}}
    <div class="breadcrumbs text-sm text-white mb-6">
        <ul>
            <li>
                <a href="{{ url('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,64H152V56h48v48Zm-96,32H56a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,200,136Zm0,64H152V152h48v48Z"></path>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ url('users') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z"></path>
                    </svg>
                    User Module
                </a>
            </li>
            <li class="active text-neutral-400">Show User</li>
        </ul>
    </div>

    <div class="card lg:card-side bg-black/40 backdrop-blur-md shadow-2xl text-white overflow-hidden">
        <figure class="lg:w-1/3">
            @php
                $photoPath = $user->photo;
                // Prepend path for manually created users or defaults
                if ($photoPath == 'no-photo.png') {
                    $src = asset('images/'.$photoPath);
                } elseif (!str_contains($photoPath, 'photos/')) {
                    $src = asset('photos/users/'.$photoPath);
                } else {
                    $src = asset($photoPath);
                }
            @endphp
            <img src="{{ $src }}" alt="{{ $user->fullname }}" class="object-cover w-full h-full" />
        </figure>
        <div class="card-body lg:w-2/3">
            <h2 class="card-title text-3xl font-bold mb-4 border-b border-neutral-700 pb-2">
                {{ $user->fullname }}
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex flex-col">
                    <span class="text-neutral-400 text-sm uppercase font-bold">Document</span>
                    <span class="text-lg">{{ $user->document }}</span>
                </div>
                
                <div class="flex flex-col">
                    <span class="text-neutral-400 text-sm uppercase font-bold">Gender</span>
                    <span class="text-lg">{{ $user->gender }}</span>
                </div>
                
                <div class="flex flex-col">
                    <span class="text-neutral-400 text-sm uppercase font-bold">Age</span>
                    <span class="text-lg">{{ \Carbon\Carbon::parse($user->birthdate)->age }} years</span>
                </div>
                
                <div class="flex flex-col">
                    <span class="text-neutral-400 text-sm uppercase font-bold">Phone Number</span>
                    <span class="text-lg">{{ $user->phone }}</span>
                </div>
                
                <div class="flex flex-col">
                    <span class="text-neutral-400 text-sm uppercase font-bold">Email Address</span>
                    <span class="text-lg font-mono text-purple-400">{{ $user->email }}</span>
                </div>
                
                <div class="flex flex-col">
                    <span class="text-neutral-400 text-sm uppercase font-bold">Role</span>
                    <span class="badge badge-outline mt-1">{{ $user->role }}</span>
                </div>

                <div class="flex flex-col">
                    <span class="text-neutral-400 text-sm uppercase font-bold">Account Status</span>
                    <span class="mt-1">
                        @if($user->active)
                            <span class="badge badge-success gap-2">Active</span>
                        @else
                            <span class="badge badge-error gap-2">Inactive</span>
                        @endif
                    </span>
                </div>

                <div class="flex flex-col">
                    <span class="text-neutral-400 text-sm uppercase font-bold">Joined On</span>
                    <span class="text-sm italic opacity-70">{{ $user->created_at->format('M d, Y') }} ({{ $user->created_at->diffForHumans() }})</span>
                </div>
            </div>

            <div class="card-actions justify-end mt-8 border-t border-neutral-700 pt-4">
                <a href="{{ route('users.index') }}" class="btn btn-outline hover:bg-white hover:text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>
    </div>
@endsection
