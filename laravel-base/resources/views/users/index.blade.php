@extends('layout')
@section('content')

    <a href="/users/create"><button class="btn btn-primary mt-5">Créer un utilisateur</button></a>

    <h1>Liste des utilisateurs</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Rôle</th>
                <th scope="col">Action</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->lastName }}</td>
                    <td>{{ $user->firstName }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>

                        @if ($user->state)
                            <a href="user/desactivate/{{ $user->id }}">
                                <button class="btn btn-danger">Désactiver</button>
                            </a>
                        @else
                            <a href="user/activate/{{ $user->id }}">
                                <button class="btn btn-success">Activer</button>
                            </a>
                        @endif
                        <a href="{{ route('users.edit', $user->id) }}">
                            <button class="btn btn-primary">Modifier</button>
                        </a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
