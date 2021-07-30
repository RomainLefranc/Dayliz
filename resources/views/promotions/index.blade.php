@extends('layout')
@section('content')
   

    <div class="d-flex justify-content-between align-items-center">
        <h1>Liste des promotions</h1>
        <a href="{{ route('promotions.create') }}"><button class="btn btn-success ">Ajouter</button></a>
    </div>
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
                <th scope="col">Token</th>

                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($promotions as $promotion)
                <tr>
                    <td>{{ $promotion->id }}</td>
                    <td>{{ $promotion->name }}</td>
                    <td>{{ $promotion->token }}</td>

                    <td>
                        <a class="btn btn-primary" href="{{ route('promotions.edit', $promotion->id) }}" role="button">Modifier</a>
                        <a class="btn btn-primary" href="{{ route('promotions.generate', $promotion->id) }}" role="button">Génerer token</a>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $promotions->links() }}
    </div>

@endsection
