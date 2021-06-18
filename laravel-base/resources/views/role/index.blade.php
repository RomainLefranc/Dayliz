@extends('layout')
@section('content')
   
     <a href="/role/create"><button class="btn btn-primary mt-5">Créer un rôle</button></a>

    <h1>Liste des roles</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('role.edit', $role->id) }}" role="button">Modifier</a>
                        <a class="btn btn-danger" href="#" role="button">Supprimer</a>
                    </td>
                </tr>
                @endforeach
            
        </tbody>
    </table>

@endsection
