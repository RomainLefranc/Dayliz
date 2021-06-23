@extends('layout')
@section('content')

<h1>Liste des utilisateurs assignés à l'activité : {{$activity->title}}</h1>
<a href="{{ route('activities.index')}}"><button class="btn btn-primary mt-5">Retour</button></a>
<a href="{{ route('activities.users.create', $activity->id)}}"><button class="btn btn-primary mt-5">Assigner utilisateur</button></a>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->firstName }}</td>
            <td>{{ $user->lastName }}</td>
            <td>
                    <form method="POST" action="{{ route('activities.users.delete', [$activity->id, $user->id]) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <div class="form-group">
                            <input type="submit" class="btn btn-danger" value="Désassigner">
                        </div>
                    </form>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection