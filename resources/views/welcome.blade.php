@extends('layouts.template')

Hello world

@auth
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button class="p-3 bg-red-200 rounded" type="submit">Logout</button>
    </form>

    {{ auth()->user()->name }}
@endauth

@guest
    <a class="p-3 bg-green-200 rounded" href="{{ route('login') }}">
        Login
    </a>
@endguest
