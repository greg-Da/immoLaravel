@extends('public.base')

@section('title', 'Login')

@section('content')

    <div class="mt-4 container">
        <h1>@yield('title')</h1>

        <form action="{{ route('login') }}" method="post">
            @csrf

            @include('shared.input', [
                'type' => 'email',
                'class' => 'my-2',
                'name' => 'email',
            ])

            @include('shared.input', [
                'type' => 'password',
                'class' => 'my-2',
                'name' => 'password',
            ])

            <button class="btn btn-primary">Se connecter</button>

        </form>
    </div>

@endsection
