@extends('layouts.app')

@section('title', 'Larapets: My Profile')

@section('content')
    @include('partials.navbar')
    <h1 class="text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256"><path d="M75.19,198.4a8,8,0,0,0,11.21-1.6,52,52,0,0,1,83.2,0,8,8,0,1,0,12.8-9.6A67.88,67.88,0,0,0,155,165.51a40,40,0,1,0-53.94,0A67.88,67.88,0,0,0,73.6,187.2,8,8,0,0,0,75.19,198.4ZM128,112a24,24,0,1,1-24,24A24,24,0,0,1,128,112Zm72-88H56A16,16,0,0,0,40,40V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V40A16,16,0,0,0,200,24Zm0,192H56V40H200ZM88,64a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H96A8,8,0,0,1,88,64Z">
                </path>
            </svg>
        My Profile
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
            <span class="inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256"><path d="M75.19,198.4a8,8,0,0,0,11.21-1.6,52,52,0,0,1,83.2,0,8,8,0,1,0,12.8-9.6A67.88,67.88,0,0,0,155,165.51a40,40,0,1,0-53.94,0A67.88,67.88,0,0,0,73.6,187.2,8,8,0,0,0,75.19,198.4ZM128,112a24,24,0,1,1-24,24A24,24,0,0,1,128,112Zm72-88H56A16,16,0,0,0,40,40V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V40A16,16,0,0,0,200,24Zm0,192H56V40H200ZM88,64a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H96A8,8,0,0,1,88,64Z">
                        </path>
                    </svg>
                My Profile
            </span>
            </li>
        </ul>
        </div>
        <div class="card text-white md:w-[720px] w-[320px] bg-black/20 p-4 mb-4 rounded">
            <form method="POST" action="{{ url('myprofile/'.$user->id) }}" class="flex flex-col md:flex-row gap-4 mt-4" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="w-full md:w-[320px]">
                    <div class="avatar flex flex-col gap-1 items-center justify-center cursor-pointer hover:scale-105 transition ease-in">
                        <div id="upload" class="mask mask-squircle w-48">
                            <img id="preview" src="{{ asset('images/users/'.$user->photo) }}" />
                        </div>
                        <small class="pb-0 border-white border-b flex gap-1 items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M208,40H48A24,24,0,0,0,24,64V176a24,24,0,0,0,24,24H208a24,24,0,0,0,24-24V64A24,24,0,0,0,208,40Zm8,136a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V64a8,8,0,0,1,8-8H208a8,8,0,0,1,8,8Zm-48,48a8,8,0,0,1-8,8H96a8,8,0,0,1,0-16h64A8,8,0,0,1,168,224ZM157.66,106.34a8,8,0,0,1-11.32,11.32L136,107.31V152a8,8,0,0,1-16,0V107.31l-10.34,10.35a8,8,0,0,1-11.32-11.32l24-24a8,8,0,0,1,11.32,0Z"></path>
                            </svg>
                            Upload Photo
                        </small>
                        @error('photo')
                            <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                        @enderror
                    </div>
                    <input type="file" id="photo" name="photo" class="hidden" accept="image/*">
                    <input type="hidden" name="originphoto" value="{{ $user->photo }}">
                </div>
                <div class="w-full md:w-[320px]">
                    {{-- Document --}}
                    <label class="label text-white">Document:</label>
                    <input type="text" class="input bg-[#0009] outline-0" name="document" placeholder="75123123" value="{{ old('document', $user->document) }}">
                    @error('document')
                        <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                    @enderror
                    {{-- FullName --}}
                    <label class="label text-white">FullName:</label>
                    <input type="text" class="input bg-[#0009] outline-0" name="fullname" placeholder="Jeremias Springfield" value="{{ old('fullname', $user->fullname) }}">
                    @error('fullname')
                        <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                    @enderror
                    {{-- Gender --}}
                    <label class="label text-white">Gender:</label>
                    <select name="gender" class="select bg-[#0009] outline-0">
                        <option value="">Select...</option>
                        <option value="Female" @if(old('gender', $user->gender) == 'Female') selected @endif>Female</option>
                        <option value="Male" @if(old('gender', $user->gender) == 'Male') selected @endif>Male</option>
                    </select>
                    @error('gender')
                        <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                    @enderror
                </div>
                <div class="w-full md:w-[320px]">
                    {{-- Birthdate --}}
                    <label class="label text-white">Birthdate:</label>
                    <input type="date" class="input bg-[#0009] outline-0" name="birthdate" placeholder="1640-10-08" value="{{ old('birthdate', $user->birthdate) }}">
                    @error('birthdate')
                        <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                    @enderror
                    {{-- Phone --}}
                    <label class="label text-white">Phone:</label>
                    <input type="text" class="input bg-[#0009] outline-0" name="phone" placeholder="3101231234" value="{{ old('phone', $user->phone) }}">
                    @error('phone')
                        <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                    @enderror
                    {{-- Email --}}
                    <label class="label text-white">Email:</label>
                    <input type="text" class="input bg-[#0009] outline-0" name="email" placeholder="Email" value="{{ old('email', $user->email) }}">
                    @error('email')
                        <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                    @enderror
                    <button class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-3 w-full">Edit</button>
                </div>
            </form>
        </div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#upload').click(function (e) { 
            e.preventDefault()
            $('#photo').click()
        })
        $('#photo').change(function (e) { 
            e.preventDefault()
            $('#preview').attr('src', window.URL.createObjectURL($(this).prop('files')[0]))
        })
    })
</script>
@endsection