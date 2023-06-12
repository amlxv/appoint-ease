@extends('layouts.template')

@section('x-content')
    <x-layouts.appointment-form action="new" :form-data="$formData"/>
@endsection
