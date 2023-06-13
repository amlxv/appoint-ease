@extends('layouts.template')

@section('x-content')
    <div class="px-4 sm:px-0 lg:px-0">
        <div class="">
            <div>
                @isPatient
                <x-patients.user-form action="edit" :form-data="$user"/>
                @endIsPatient

                @isDoctor
                <x-doctors.user-form action="edit" :form-data="$user"/>
                @endIsDoctor
            </div>
        </div>
    </div>
@endsection
