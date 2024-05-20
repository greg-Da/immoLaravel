@extends('public.base')

@section('title', $property->title)

@section('content')

    <div class="container">

        <h1>{{ $property->title }}</h1>
        <h2>{{ $property->address }} - {{ $property->city->name }} - {{ $property->zipCode }}</h2>

        <div class="text-primary fw-bold">
            {{ $property->getFormattedPrice() }}
        </div>


        <div class="mt-4">
            <p>{{ nl2br($property->description) }}</p>
            <div class="row">
                <div class="col-8">
                    <h2>Caracteristiques</h2>

                    <table class="table table-striped">
                        <tr>
                            <td>Surface Habitable</td>
                            <td>{{ $property->surface }}</td>
                        </tr>

                        <tr>
                            <td>Pieces</td>
                            <td>{{ $property->nmbRoom }}</td>
                        </tr>

                        <tr>
                            <td>Chambres</td>
                            <td>{{ $property->nmbBedroom }}</td>
                        </tr>

                        <tr>
                            <td>Nombre d'etages</td>
                            <td>{{ $property->floorCount }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-4">
                    <h2>Specificites</h2>
                    <ul class="list-group">
                        @foreach ($property->options as $option)
                            <li class="list-group-item">{{ $option->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <hr>

        <div class="mt-4">
            <p>
                Ce bien vous interresse ?
            </p>

            <form action="{{route('property.contact', $property)}}" method="post">
                @csrf

                <div class="row">
                    @include('shared.input', [
                        'class' => 'col',
                        'name' => 'firstName',
                        'label' => 'Prenom',
                    ])

                    @include('shared.input', [
                        'class' => 'col',
                        'name' => 'lastName',
                        'label' => 'Nom',
                    ])

                </div>

                <div class="row">


                    @include('shared.input', [
                        'class' => 'col',
                        'name' => 'phone',
                        'label' => 'Telephone',
                    ])

                    @include('shared.input', [
                        'class' => 'col',
                        'name' => 'email',
                        'label' => 'Email',
                        'type' => 'email',
                    ])

                </div>

                @include('shared.input', [
                    'class' => 'col',
                    'name' => 'message',
                    'label' => 'Votre message',
                    'type' => 'textarea',
                ])

                <div class="mt-4">
                    <button class="btn btn-primary">Nous contacter</button>

                </div>
            </form>
        </div>
    </div>

@endsection
