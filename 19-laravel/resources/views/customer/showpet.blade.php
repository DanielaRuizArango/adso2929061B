@extends('layouts.app')

@section('title', 'Larapets: Make Adoption')

@section('content')
    @include('partials.navbar')
        <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256"><path d="M230.33,141.06a24.34,24.34,0,0,0-18.61-4.77C230.5,117.33,240,98.48,240,80c0-26.47-21.29-48-47.46-48A47.58,47.58,0,0,0,156,48.75,47.58,47.58,0,0,0,119.46,32C93.29,32,72,53.53,72,80c0,11,3.24,21.69,10.06,33a31.87,31.87,0,0,0-14.75,8.4L44.69,144H16A16,16,0,0,0,0,160v40a16,16,0,0,0,16,16H120a7.93,7.93,0,0,0,1.94-.24l64-16a6.94,6.94,0,0,0,1.19-.4L226,182.82l.44-.2a24.6,24.6,0,0,0,3.93-41.56Z"></path></svg>
        Make Adoption
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
            <a href="{{ url('listpets') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256"><path d="M212,80a28,28,0,1,0,28,28A28,28,0,0,0,212,80Zm0,40a12,12,0,1,1,12-12A12,12,0,0,1,212,120ZM72,108a28,28,0,1,0-28,28A28,28,0,0,0,72,108ZM44,120a12,12,0,1,1,12-12A12,12,0,0,1,44,120ZM92,88A28,28,0,1,0,64,60,28,28,0,0,0,92,88Zm0-40A12,12,0,1,1,80,60,12,12,0,0,1,92,48Zm72,40a28,28,0,1,0-28-28A28,28,0,0,0,164,88Zm0-40a12,12,0,1,1-12,12A12,12,0,0,1,164,48Zm23.12,100.86a35.3,35.3,0,0,1-16.87-21.14,44,44,0,0,0-84.5,0A35.25,35.25,0,0,1,69,148.82,40,40,0,0,0,88,224a39.48,39.48,0,0,0,15.52-3.13,64.09,64.09,0,0,1,48.87,0,40,40,0,0,0,34.73-72ZM168,208a24,24,0,0,1-9.45-1.93,80.14,80.14,0,0,0-61.19,0,24,24,0,0,1-20.71-43.26,51.22,51.22,0,0,0,24.46-30.67,28,28,0,0,1,53.78,0,51.27,51.27,0,0,0,24.53,30.71A24,24,0,0,1,168,208Z"></path></svg>
                List Pets
            </a>
            </li>
            <li>
            <span class="inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256"><path d="M230.33,141.06a24.34,24.34,0,0,0-18.61-4.77C230.5,117.33,240,98.48,240,80c0-26.47-21.29-48-47.46-48A47.58,47.58,0,0,0,156,48.75,47.58,47.58,0,0,0,119.46,32C93.29,32,72,53.53,72,80c0,11,3.24,21.69,10.06,33a31.87,31.87,0,0,0-14.75,8.4L44.69,144H16A16,16,0,0,0,0,160v40a16,16,0,0,0,16,16H120a7.93,7.93,0,0,0,1.94-.24l64-16a6.94,6.94,0,0,0,1.19-.4L226,182.82l.44-.2a24.6,24.6,0,0,0,3.93-41.56Z"></path></svg>
                Make Adoption
            </span>
            </li>
        </ul>
        </div>
    <div class="card card-side bg-base-100 shadow-sm">
        <figure class="w-64 overflow-hidden">
            <img
                src="{{ asset('images/pets/'.$pet->image)}}"
                class="w-full h-full object-cover" />
        </figure>
        <div class="card-body">
            <h2 class="card-title text-2xl mb-4 text-black">{{ $pet->name }}</h2>

            <div class="space-y-2 text-base text-black">
                <p><span class="font-semibold">Kind:</span>
                    @switch($pet->kind)
                        @case('dog') Dog @break
                        @case('cat') Cat @break
                        @case('pig') Pig @break
                        @default Bird
                    @endswitch
                </p>
                <p><span class="font-semibold">Breed:</span> {{ $pet->breed }}</p>
                <p><span class="font-semibold">Weight:</span> {{ $pet->weight }} kg</p>
                <p><span class="font-semibold">Age:</span> {{ $pet->age }} years</p>
                <p><span class="font-semibold">Location:</span> {{ $pet->location }}</p>
                <p><span class="font-semibold">Description:</span> {{ $pet->description }}</p>
                <p>
                    <span class="font-semibold">Status:</span>
                    @if($pet->active == '1')
                        <span class="badge badge-outline badge-success">Active</span>
                    @else
                        <span class="badge badge-outline badge-error">Inactive</span>
                    @endif
                </p>
                <p>
                    <span class="font-semibold">Adopted:</span>
                    @if($pet->adopted == '1')
                        <span class="badge badge-outline badge-info">Adopted</span>
                    @else
                        <span class="badge badge-outline badge-success">Available</span>
                    @endif
                </p>
                <p>
                    <span class="font-semibold">Created At:</span>
                    <span class="text-sm opacity-70">
                        {{ $pet->created_at->diffForHumans() }}
                    </span>
                </p>
            </div>
            <a href="javascript:;" class="btn btn-success mt-4 flex mx-auto btn-xl btn-adopt" data-name="{{ $pet->name }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256"><path d="M230.33,141.06a24.34,24.34,0,0,0-18.61-4.77C230.5,117.33,240,98.48,240,80c0-26.47-21.29-48-47.46-48A47.58,47.58,0,0,0,156,48.75,47.58,47.58,0,0,0,119.46,32C93.29,32,72,53.53,72,80c0,11,3.24,21.69,10.06,33a31.87,31.87,0,0,0-14.75,8.4L44.69,144H16A16,16,0,0,0,0,160v40a16,16,0,0,0,16,16H120a7.93,7.93,0,0,0,1.94-.24l64-16a6.94,6.94,0,0,0,1.19-.4L226,182.82l.44-.2a24.6,24.6,0,0,0,3.93-41.56Z"></path></svg>
                Make Adoption
            </a>
            <form class="hidden" action="{{url('makeadoption/'. $pet->id)}}" method="POST">
                <input type="hidden" name="pet_id" value="{{ $pet->id }}">
                @csrf
            </form>
        </div>
    </div>

@endsection

@section('js')
<script>
    $('.btn-adopt').click(function() {
        $name = $(this).attr('data-name')
        Swal.fire({
            title: "Are you sure?",
            text: "The Pet: "+$name+"  will be adopted!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Adopt It!"
            }).then((result) => {
            if (result.isConfirmed) {
                $(this).next().submit();
            }
        });
    });
</script>
@endsection