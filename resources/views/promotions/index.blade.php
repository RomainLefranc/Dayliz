@extends('layout')
@section('content')
   
     <a href="{{ route('promotions.create') }}"><button class="btn btn-primary mt-5">Créer une promotion</button></a>

    <h1>Liste des promotions</h1>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            
                @foreach ($promotions as $promotion)
                <tr>
                    <td>{{ $promotion->id }}</td>
                    <td>{{ $promotion->name }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('promotions.edit', $promotion->id) }}" role="button">Modifier</a>
                        <form method="POST" action="{{ route('promotions.destroy', [$promotion->id]) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
    
                            <div class="form-group">
                                <input type="submit" class="btn btn-danger" value="Supprimer">
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            
        </tbody>
    </table>

@endsection
