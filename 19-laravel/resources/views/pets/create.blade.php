@extends('layouts.app')

@section('title', 'Larapets: Add User')

@section('content')
    @include('partials.navbar')
        <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-12"  fill="currentColor" viewBox="0 0 256 256">
                <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48-88a8,8,0,0,1-8,8H136v32a8,8,0,0,1-16,0V136H88a8,8,0,0,1,0-16h32V88a8,8,0,0,1,16,0v32h32A8,8,0,0,1,176,128Z"></path>
            </svg>
        Add Pet
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
            <a href="{{ url('pets') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z"></path>
                </svg>
                Pet Module
            </a>
            </li>
            <li>
            <span class="inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4"  fill="currentColor" viewBox="0 0 256 256">
                    <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48-88a8,8,0,0,1-8,8H136v32a8,8,0,0,1-16,0V136H88a8,8,0,0,1,0-16h32V88a8,8,0,0,1,16,0v32h32A8,8,0,0,1,176,128Z"></path>
                </svg>
                Add Pet
            </span>
            </li>
        </ul>
        </div>
        <div class="card text-white md:w-[720px] w-[320px]">
            <form method="POST" action="{{ url('pets') }}" class="flex flex-col md:flex-row gap-4 mt-4" enctype="multipart/form-data">
                @csrf
                <div class="w-full md:w-[320px]">
                    <div class="avatar flex flex-col gap-1 items-center justify-center cursor-pointer hover:scale-105 transition ease-in">
                        <div id="upload" class="mask mask-squircle w-48">
                            <img id="preview" src="{{ asset('images/no-photo.png') }}" />
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
                </div>
                <div class="w-full md:w-[320px]">
                    {{-- Name --}}
                    <label class="label text-white">Name:</label>
                    <input type="text" class="input bg-[#0009] outline-0" name="name" placeholder="75123123" value="{{ old('name') }}">
                    @error('name')
                        <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                    @enderror
                    {{-- Kind --}}
                    <label class="label text-white">Kind:</label>
                    <input type="text" class="input bg-[#0009] outline-0" name="kind" placeholder="Jeremias Springfield" value="{{ old('kind') }}">
                    @error('kind')
                        <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                    @enderror
                    {{-- Weight --}}
                    <label class="label text-white">Weight:</label>
                    <input type="number" class="input bg-[#0009] outline-0" name="weight" placeholder="75123123" value="{{ old('weight') }}">
                    @error('weight')
                        <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                    @enderror
                    {{-- Age --}}
                    <label class="label text-white">Age:</label>
                    <input type="number" class="input bg-[#0009] outline-0" name="age" placeholder="1640-10-08" value="{{ old('age') }}">
                    @error('age')
                        <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                    @enderror
                </div>
                <div class="w-full md:w-[320px]">
                    {{-- Breed --}}
                    <label class="label text-white">Breed:</label>
                    <input type="text" class="input bg-[#0009] outline-0" name="breed" placeholder="3101231234" value="{{ old('breed') }}">
                    @error('breed')
                        <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                    @enderror
                    {{-- Location --}}
                    <label class="label text-white">Location:</label>
                    <input type="text" class="input bg-[#0009] outline-0" name="location" placeholder="Email" value="{{ old('location') }}">
                    @error('location')
                        <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                    @enderror
                    {{-- Description --}}
                    <label class="label text-white">Description:</label>
                    <input type="text" class="input bg-[#0009] outline-0" name="description" placeholder="Secret">
                    @error('description')
                        <small class="badge badge-error w-full mt-1 text-xs py-3">{{ $message }}</small>
                    @enderror
                    {{-- Active --}}
                    <label class="label text-white">Active:</label>
                    <input type="checkbox" class="input bg-[#0009] outline-0" name="active" placeholder="Secret">
                    @error('active')
                        <small class="badge badge-error w-full mt-1 text-xs py-3">{{ $message }}</small>
                    @enderror
                    {{-- Adopted --}}
                    <label class="label text-white">Adopted:</label>
                    <input type="checkbox" class="input bg-[#0009] outline-0" name="adopted" placeholder="Secret">
                    @error('adopted')
                        <small class="badge badge-error w-full mt-1 text-xs py-3">{{ $message }}</small>
                    @enderror

                    <button class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-3 w-full">Add</button>
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
            $('#preview').attr('src', window.URL.createObjectURL(this.files[0]))
        })
    })
</script>
@endsection