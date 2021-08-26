@extends('layout')
@section('content')
   
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif


    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1>Liste des promotions</h1>
            <a href="{{ route('promotions.create') }}"><button class="btn btn-success "><i class="fas fa-plus"></i></button></a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
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
                                <a class="btn btn-primary" href="{{ route('promotions.edit', $promotion->id) }}" role="button"><i class="far fa-edit"></i></a>
                                @if ($promotion->state == 0)
                                    <a class="btn btn-success" href="{{ route('promotions.activate', $promotion->id) }}" role="button"><i class="fas fa-trash-restore"></i></a>
                                @else
                                    <a class="btn btn-danger" href="{{ route('promotions.desactivate', $promotion->id) }}" role="button"><i class="fas fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-2">
        {{ $promotions->links() }}
    </div>

@endsection
