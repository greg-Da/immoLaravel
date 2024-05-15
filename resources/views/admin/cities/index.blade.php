@extends('admin.base')

@section('title', 'Toutes nos villes')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>Les villes</h1>
        <a href="{{ route('admin.city.create') }}" class="btn btn-primary">Ajouter une ville</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cities as $city)
                <tr>

                    <td>{{ $city->name }}</td>
                    <td>
                        <div class="d-flex justify-content-end w-100 gap-2">
                            <a href="{{ route('admin.city.edit', $city) }}" class="btn btn-primary">Editer</a>
                            <form action="{{ route('admin.city.destroy', $city)}}" method="POST">
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
    {{ $cities->links() }}

@endsection
