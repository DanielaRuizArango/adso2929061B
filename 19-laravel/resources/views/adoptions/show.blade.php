@extends('layouts.app')
 
@section('title', 'Larapets: Show Adoption')
 
@section('content')
    @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
            <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
        </svg>
        Show Adoption
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
                <a href="{{ url('adoptions') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M178,40c-20.65,0-38.73,8.88-50,23.89C116.73,48.88,98.65,40,78,40a62.07,62.07,0,0,0-62,62c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,228.66,240,172,240,102A62.07,62.07,0,0,0,178,40ZM128,214.8C109.74,204.16,32,155.69,32,102A46.06,46.06,0,0,1,78,56c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,155.61,146.24,204.15,128,214.8Z"></path>
                    </svg>
                    Adoption Module
                </a>
                </li>
                <li>
                <span class="inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                    </svg>
                    Show Adoption
                </span>
                </li>
            </ul>
        </div>
        {{-- Card --}}
        <div class="bg-[#0009] p-10 rounded-sm flex flex-col items-center">
            {{-- Image --}}
            <div class="avatar-group -space-x-6">
                <div class="avatar">
                    <div class="w-36">
                    <img src="{{ asset('images/'.$adopt->user->photo) }}" />
                    </div>
                </div>
                <div class="avatar">
                    <div class="w-36">
                    <img src="{{ asset('images/'.$adopt->pet->image) }}" />
                    </div>
                </div>
            </div>
            {{-- Data --}}
            <div class="flex gap-2 flex-col md:flex-row">
                <ul class="list bg-[#0006] mt-4 text-white rounded-box shadow-md w-64">
                    <li class="list-row">
                        <span class="text-[#fff9] font-semibold">Document:</span> <span>{{ $adopt->user->document }}</span>
                    </li>
                    <li class="list-row">
                        <span class="text-[#fff9] font-semibold">FullName:</span> <span>{{ $adopt->user->fullname }}</span>
                    </li>
                    <li class="list-row">
                        <span class="text-[#fff9] font-semibold">Gender:</span> <span>{{ $adopt->user->gender }}</span>
                    </li>
                    <li class="list-row">
                        <span class="text-[#fff9] font-semibold">Age:</span> <span>{{ Carbon\Carbon::parse($adopt->user->birthdate)->age }} years old</span>
                    </li>
                    <li class="list-row">
                        <span class="text-[#fff9] font-semibold">Phone:</span> <span>{{ $adopt->user->phone }}</span>
                    </li>
                    <li class="list-row">
                        <span class="text-[#fff9] font-semibold">Email:</span> <span>{{ $adopt->user->email }}</span>
                    </li>
                    <li class="list-row">
                        <span class="text-[#fff9] font-semibold">Active:</span>
                        <span>
                            @if ($adopt->user->active == 1)
                                <div class="badge badge-outline badge-success">Active</div>
                            @else
                                <div class="badge badge-outline badge-error">Inactive</div>
                            @endif
                        </span>
                    </li>
                    <li class="list-row">
                        <span class="text-[#fff9] font-semibold">Role:</span>
                        <span>
                            @if ($adopt->user->role == 'Administrator')
                                <div class="badge badge-outline badge-warning">Admin</div>
                            @else
                                <div class="badge badge-outline badge-default">Customer</div>
                            @endif
                        </span>
                    </li>
                </ul>
                <ul class="list bg-[#0006] mt-4 text-white rounded-box shadow-md w-64">
                    <li class="list-row">
                        <span class="text-[#fff9] font-semibold">Name:</span> <span>{{ $adopt->pet->name }}</span>
                    </li>
                    <li class="list-row">
                        <span class="text-[#fff9] font-semibold">Kind:</span> <span>
                            @if($adopt->pet->kind == 'Dog')
                                <div class="badge badge-outline badge-info">Dog</div>
                            @elseif ($adopt->pet->kind == 'Cat')
                                <div class="badge badge-outline badge-secondary">Cat</div>
                            @elseif ($adopt->pet->kind == 'Pig')
                                <div class="badge badge-outline badge-success">Pig</div>
                            @elseif ($adopt->pet->kind == 'Bird')
                                <div class="badge badge-outline badge-warning">Bird</div>
                            @endif
                        </span>
                    </li>
                    <li class="list-row">
                        <span class="text-[#fff9] font-semibold">Breed:</span> <span>{{ $adopt->pet->breed }}</span>
                    </li>
                    <li class="list-row">
                        <span class="text-[#fff9] font-semibold">Weight:</span> <span>{{ $adopt->pet->weight }} lbs</span>
                    </li>
                    <li class="list-row">
                        <span class="text-[#fff9] font-semibold">Age:</span> <span>{{ $adopt->pet->age }} years old</span>
                    </li>
                    <li class="list-row">
                        <span class="text-[#fff9] font-semibold">Location:</span>
                        <span>{{ $adopt->pet->location }}</span>
                    </li>
                    <li class="list-row">
                        <span class="text-[#fff9] font-semibold">Active:</span>
                        <span>
                            @if($adopt->pet->active == 1)
                                <div class="badge badge-outline badge-success">Yes</div>
                            @else
                                <div class="badge badge-outline badge-error">No</div>
                            @endif
                        </span>
                    </li>
                    <li class="list-row">
                        <span class="text-[#fff9] font-semibold">Status:</span>
                        <span>
                            @if($adopt->pet->status == 0)
                                <div class="badge badge-outline badge-success">Avaliable</div>
                            @else
                                <div class="badge badge-outline badge-error">Adopted</div>
                            @endif
                        </span>
                    </li>
                </ul>
            </div>
        </div>
@endsection