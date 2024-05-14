@extends('admin.base')


@section('title', $property->exists ? 'Editer un bien' : 'Créer un bien')

@section('content')

    <h1>@yield('title')</h1>

    <form class='vstack gap-2'
        action="{{ route($property->exists ? 'admin.property.update' : 'admin.property.store', $property) }}" method="post">

        @csrf
        @method($property->exists ? 'put' : 'post')

        <div class="row">
            <div class="col row">

                @include('shared.input', [
                    'class' => 'col',
                    'label' => 'Titre',
                    'name' => 'title',
                    'value' => $property->title,
                ])
            </div>

            <div class="col row">
                @include('shared.input', [
                    'class' => 'col',
                    'name' => 'surface',
                    'value' => $property->surface,
                ])


                @include('shared.input', [
                    'class' => 'col',
                    'label' => 'Prix',
                    'name' => 'price',
                    'value' => $property->price,
                ])
            </div>
        </div>

        <div class="row">
            @include('shared.input', [
                'name' => 'description',
                'value' => $property->description,
                'type' => 'textarea',
            ])
        </div>

        <div class="row">
            <div class="col row">
                @include('shared.input', [
                    'label' => 'Nombre de Pieces',
                    'class' => 'col',
                    'name' => 'nmbRoom',
                    'value' => $property->nmbRoom,
                ])


                @include('shared.input', [
                    'label' => 'Nombre de chambres',
                    'class' => 'col',
                    'name' => 'nmbBedroom',
                    'value' => $property->nmbBedroom,
                ])

                @include('shared.input', [
                    'label' => "Nombre d'etages",
                    'class' => 'col',
                    'name' => 'floorCount',
                    'value' => $property->floorCount,
                ])
            </div>
        </div>

        <div class="row">
            <div class="col row">
                @include('shared.input', [
                    'label' => 'Adresse',
                    'class' => 'col',
                    'name' => 'address',
                    'value' => $property->address,
                ])


                @include('shared.input', [
                    'label' => 'Code Postal',
                    'class' => 'col',
                    'name' => 'zipCode',
                    'value' => $property->zipCode,
                ])

                @include('shared.select', [
                    'class' => 'col',
                    'label' => 'Ville',
                    'name' => 'city_id',
                    'options' => $cities,
                    'placeholder' => 'Choisir une ville',
                    'optionValue' => 'id',
                    'optionDisplay' => 'name',
                    'defaultValue' => $property->city_id
                ])
            </div>

            @include('shared.switch', [
                'label' => 'Vendu',
                'name' => 'sold',
                'value' => $property->sold,
            ])

            <div>
                <button class="btn btn-primary">
                    @if ($property->exists)
                        Modifier
                    @else
                        Créer
                    @endif
                </button>
            </div>
    </form>

@endsection
