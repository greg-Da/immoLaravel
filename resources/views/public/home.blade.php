@extends('public.base')

@section('title', 'Home')

@section('content')

    <div class="bg-light p-5 mb-5 text-center">
        <div class="container">
            <h1>AgenceLaravel</h1>
        </div>
    </div>

    <div class="container">
        <h2 class="text-center mb-5">Nos derniers biens</h2>
        <div class="row">
            @foreach ($properties as $property)
                <div class="col">
                    @include('shared.property.card')
                </div>
            @endforeach
        </div>

    </div>

@endsection
