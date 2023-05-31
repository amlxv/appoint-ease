@extends('layouts.template')

@section('x-content')
    <x-layouts.user-table-layout title="Patients" description="A list of all the registered patients in the system."
                                 add-button-text="Add patient" :route="route('patients.create')">
        <x-tables.user-table :$tableData/>
    </x-layouts.user-table-layout>
@endsection
