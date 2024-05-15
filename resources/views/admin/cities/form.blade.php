@extends('admin.base')


@section('title', $city->exists ? 'Editer une ville' : 'Créer une ville')

@section('content')

    <h1>@yield('title')</h1>

    <form class='vstack gap-2'
        action="{{ route($city->exists ? 'admin.city.update' : 'admin.city.store', $city) }}" method="post">

        @csrf
        @method($city->exists ? 'put' : 'post')

        <div class="row">

            @include('shared.input', [
                'label' => 'Name',
                'name' => 'name',
                'value' => $city->name,
            ])
        </div>



        <div>
            <button class="btn btn-primary">
                @if ($city->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>
        </div>
    </form>

@endsection
