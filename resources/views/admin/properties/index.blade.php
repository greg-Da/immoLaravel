@extends('admin.base')

@section('title', 'Tous nos biens')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>Les biens</h1>
        <a href="{{ route('admin.property.create') }}" class="btn btn-primary">Ajouter un bien</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Surface</th>
                <th>Prix</th>
                <th>Ville</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($properties as $property)
                <tr>

                    <td>{{ $property->title }}</td>
                    <td>{{ $property->surface }}m2</td>
                    <td>{{ $property->getFormattedPrice() }}</td>
                    <td>{{ $property->city->name }}</td>
                    <td>
                        <div class="d-flex justify-content-end w-100 gap-2">
                            <a href="{{ route('admin.property.edit', $property) }}" class="btn btn-primary">Editer</a>
                            <form action="{{ route('admin.property.destroy', $property)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>


    </table>
    {{ $properties->links() }}

@endsection
