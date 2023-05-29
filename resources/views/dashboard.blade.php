@extends('layouts.template')

@section('x-content')
    Hello world


    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button class="p-3 bg-red-200 rounded" type="submit">Logout</button>
    </form>

    {{ auth()->user()->email }}
@endsection
