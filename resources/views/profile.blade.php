@extends('layouts.template')

@section('x-content')
    <div class="px-4 sm:px-0 lg:px-0">
        <div class="">
            <div>
                @if(auth()->user()->isPatient())
                    <x-patients.user-form action="edit" :form-data="$user"/>
                @endif

                @if(auth()->user()->isDoctor())
                    <x-doctors.user-form action="edit" :form-data="$user"/>
                @endif
            </div>
        </div>
    </div>
@endsection
