@extends('layouts.template')

@section('x-content')
    <x-layouts.user-table-layout title="Doctors" description="A list of all the registered doctors in the system."
                                 add-button-text="Add doctor" :route="route('doctors.create')">
        <x-tables.user-table :$tableData/>
    </x-layouts.user-table-layout>
@endsection
