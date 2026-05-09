@extends('layouts.app')

@section('title', 'Larapets: List pets')

@section('content')
    @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256"><path d="M212,80a28,28,0,1,0,28,28A28,28,0,0,0,212,80Zm0,40a12,12,0,1,1,12-12A12,12,0,0,1,212,120ZM72,108a28,28,0,1,0-28,28A28,28,0,0,0,72,108ZM44,120a12,12,0,1,1,12-12A12,12,0,0,1,44,120ZM92,88A28,28,0,1,0,64,60,28,28,0,0,0,92,88Zm0-40A12,12,0,1,1,80,60,12,12,0,0,1,92,48Zm72,40a28,28,0,1,0-28-28A28,28,0,0,0,164,88Zm0-40a12,12,0,1,1-12,12A12,12,0,0,1,164,48Zm23.12,100.86a35.3,35.3,0,0,1-16.87-21.14,44,44,0,0,0-84.5,0A35.25,35.25,0,0,1,69,148.82,40,40,0,0,0,88,224a39.48,39.48,0,0,0,15.52-3.13,64.09,64.09,0,0,1,48.87,0,40,40,0,0,0,34.73-72ZM168,208a24,24,0,0,1-9.45-1.93,80.14,80.14,0,0,0-61.19,0,24,24,0,0,1-20.71-43.26,51.22,51.22,0,0,0,24.46-30.67,28,28,0,0,1,53.78,0,51.27,51.27,0,0,0,24.53,30.71A24,24,0,0,1,168,208Z"></path></svg>
            List Pets
    </h1>

    {{-- Breadcrumbs --}}
    <div class="breadcrumbs text-sm text-white mb-6">
        <ul>
            <li>
                <a href="{{ url('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256"><path d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,64H152V56h48v48Zm-96,32H56a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,200,136Zm0,64H152V152h48v48Z"></path></svg>
                    Dashboard
                </a>
            </li>
            <li>
                <span class="inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256"><path d="M212,80a28,28,0,1,0,28,28A28,28,0,0,0,212,80Zm0,40a12,12,0,1,1,12-12A12,12,0,0,1,212,120ZM72,108a28,28,0,1,0-28,28A28,28,0,0,0,72,108ZM44,120a12,12,0,1,1,12-12A12,12,0,0,1,44,120ZM92,88A28,28,0,1,0,64,60,28,28,0,0,0,92,88Zm0-40A12,12,0,1,1,80,60,12,12,0,0,1,92,48Zm72,40a28,28,0,1,0-28-28A28,28,0,0,0,164,88Zm0-40a12,12,0,1,1-12,12A12,12,0,0,1,164,48Zm23.12,100.86a35.3,35.3,0,0,1-16.87-21.14,44,44,0,0,0-84.5,0A35.25,35.25,0,0,1,69,148.82,40,40,0,0,0,88,224a39.48,39.48,0,0,0,15.52-3.13,64.09,64.09,0,0,1,48.87,0,40,40,0,0,0,34.73-72ZM168,208a24,24,0,0,1-9.45-1.93,80.14,80.14,0,0,0-61.19,0,24,24,0,0,1-20.71-43.26,51.22,51.22,0,0,0,24.46-30.67,28,28,0,0,1,53.78,0,51.27,51.27,0,0,0,24.53,30.71A24,24,0,0,1,168,208Z"></path></svg>
                    List Pets
                </span>
            </li>
        </ul>
    </div>

    {{-- Search --}}
    <label class="input text-white bg-[#0009] w-58 md:w-112 outline outline-white mb-10">
        <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.3-4.3"></path>
            </g>
        </svg>
        <input type="search" placeholder="Search..." name="qsearch" id="qsearch" />
    </label>

    <div class="overflow-x-auto mb-10 rounded-box border border-base-content/5 bg-black/50">
        <table class="table">
            <thead class="text-white bg-black">
                <tr>
                    <th class="hidden md:table-cell">ID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Kind</th>
                    <th class="hidden md:table-cell">Breed</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="datalist">
                @foreach($pets as $pet)
                    <tr class="even:bg-white/10">
                        <td class="hidden md:table-cell">{{ $pet->id }}</td>
                        <td>
                            <div class="avatar">
                                <div class="mask mask-squircle w-18">
                                    <img src="{{ asset('images/pets/'.$pet->image)}}" />
                                </div>
                            </div>
                        </td>
                        <td>{{ $pet->name }}</td>
                        <td>
                            @switch($pet->kind)
                                @case('dog')
                                    <span class="badge badge-soft badge-secondary">Dog</span>
                                    @break
                                @case('cat')
                                    <span class="badge badge-soft badge-primary">Cat</span>
                                    @break
                                @case('pig')
                                    <span class="badge badge-soft badge-accent">Pig</span>
                                    @break
                                @default
                                    <span class="badge badge-soft badge-warning">Bird</span>
                            @endswitch
                        </td>
                        <td class="hidden md:table-cell">{{$pet->breed}}</td>
                        <td>
                            <a href="{{url('confirmadoption/'.$pet->id)}}" class="btn btn-xs btn-outline btn-default">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256"><path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path></svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7">{{$pets->links('partials.pagination')}}</td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('js')
<script>
    @if(session('message'))
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('message') }}",
            showConfirmButton: false,
            timer: 4500
        });
    @endif

    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    const search = debounce(function(query) {
        const token = $('meta[name="csrf-token"]').attr('content');
        
        $.post("{{ url('search/adoptionpets') }}", {'q': query, '_token': token},
            function (data) {
                $('.datalist').html(data).hide().fadeIn(1000);
            }
        );
    }, 500);

    $('body').on('input', '#qsearch', function(event) {
        event.preventDefault();
        const query = $(this).val();
        
        $('.datalist').html(`<tr>
            <td colspan="6" class="text-center py-18">
                <span class="loading loading-spinner loading-xl"></span>
            </td>
        </tr>`);

        if(query != '') {
            search(query);
        } else {
            setTimeout(() => {
                window.location.replace('{{ url("listpets") }}');
            }, 500);
        }
    });
</script>
@endsection