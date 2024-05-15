@extends('admin.base')

@section('title', 'Toutes nos options')

@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>Les options</h1>
        <a href="{{ route('admin.option.create') }}" class="btn btn-primary">Ajouter une option</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($options as $option)
                <tr>

                    <td>{{ $option->name }}</td>
                    <td>
                        <div class="d-flex justify-content-end w-100 gap-2">
                            <a href="{{ route('admin.option.edit', $option) }}" class="btn btn-primary">Editer</a>
                            <form action="{{ route('admin.option.destroy', $option)}}" method="POST">
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
    {{ $options->links() }}

@endsection
