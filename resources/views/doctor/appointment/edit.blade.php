@extends('layouts.template')

@section('x-content')
    <x-layouts.appointment-form action="edit" :form-data="$formData"/>
@endsection
