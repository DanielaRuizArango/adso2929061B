@extends('layouts.app')

@section('title, Larapets: Dashboard')

@section('content')

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a class="btn btn-o" href="route('logout')"
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                        Log Out
                    </a>
                </form>
@endsection