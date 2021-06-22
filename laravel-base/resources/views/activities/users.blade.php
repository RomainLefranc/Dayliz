@extends('layout')
@section('content')
<a href="{{ route('activities.user.create'), $activity->id}}"><button class="btn btn-primary mt-5">Ajouter utilisateur</button></a>
<a href="{{ route('activities.index')}}"><button class="btn btn-primary mt-5">Liste des activités</button></a>
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
                    <form method="POST" action="{{ route('activities.user.delete'), $activity->id, $user->id }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <div class="form-group">
                            <input type="submit" class="btn btn-danger" value="Supprimer">
                        </div>
                    </form>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection