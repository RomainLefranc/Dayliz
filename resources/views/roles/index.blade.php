@extends('layout')
@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card" >
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1>Liste des roles</h1>
            <a href="{{ route('roles.create') }}"><button class="btn btn-success"><i class="fas fa-plus"></i></button></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                                    <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}" role="button"><i class="far fa-edit"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        
                    </tbody>
                </table>
            </div>
            
        </div>
      </div>


@endsection
