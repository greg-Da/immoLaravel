@extends('public.base')

@section('title', 'Tous nos biens')

@section('content')


    <div class="bg-light p-5 mb-5 text-center">
        <form action="" method="GET" class="container">
            <input type="number" placeholder="Buddget Max" class="form-control" name="price"
                value="{{ $input['price'] ?? '' }}">
            <input type="number" placeholder="Surface Min" class="form-control" name="surfaceMin"
                value="{{ $input['surfaceMin'] ?? '' }}">
            <input type="number" placeholder="Surface Max" class="form-control" name="surfaceMax"
                value="{{ $input['surfaceMax'] ?? '' }}">
                <input type="number" placeholder="Nmb Pieces Min" class="form-control" name="nmbRoom"
                value="{{ $input['nmbRoom'] ?? '' }}">
                <input type="number" placeholder="Nmb Chambres Min" class="form-control" name="nmbBedroom"
                value="{{ $input['nmbBedroom'] ?? '' }}">
            <input type="text" placeholder="Mot clef" class="form-control" name="title"
                value="{{ $input['title'] ?? '' }}">

            <button class="btn btn-primary btn-sm">Chercher</button>
        </form>
    </div>

    <div class="container">
        <div class="row">
            @forelse ($properties as $property)
                <div class="col-4 my-2">
                    @include('shared.property.card')
                </div>

                @empty
                <div class="my-2">
                    <p class="text-center">Aucun bien ne correspond</p>
                </div>
            @endforelse
        </div>
    </div>

    {{ $properties->links() }}

@endsection
