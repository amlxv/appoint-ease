@extends('layouts.template')

@section('x-content')
    <x-patients.user-form action="edit" :formData="$patient"/>
@endsection
