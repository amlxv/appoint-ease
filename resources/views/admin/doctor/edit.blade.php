@extends('layouts.template')

@section('x-content')
    <x-doctors.user-form action="edit" :formData="$doctor"/>
@endsection
