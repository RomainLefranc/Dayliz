@extends('layout')
@section('content')
    @include('dataTables')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Liste des utilisateurs</h1>
        <a href="{{ route('users.create') }}"><button class="btn btn-success">Ajouter</button></a>
    </div>

    <table class="table table-striped table-hover" id="dataTableUser">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Rôle</th>
                <th scope="col">Promotion</th>
                <th scope="col">Token</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td scope="col">{{ $user->firstName }}</td>
                    <td scope="col">{{ $user->lastName }}</td>
                    <td scope="col">{{ $user->role->name }}</td>
                    <td scope="col">{{ $user->promotion->name }}</td>
                    <td scope="col">{{ $user->tokenRandom }}</td>
                    <td scope="col">
                        <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}" role="button">Modifier</a>
                        @if ($user->state == 0)
                            <a class="btn btn-success" href="{{ route('users.activate', $user->id) }}" role="button">Activer</a>
                        @else
                            <a class="btn btn-danger" href="{{ route('users.desactivate', $user->id) }}" role="button">Désactiver</a>
                        @endif
                        <a class="btn btn-primary" href="{{ route('users.generate', $user->id) }}" role="button">Génerer token</a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>


@endsection
