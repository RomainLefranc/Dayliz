@extends('layout')
@section('content')
    @include('dataTables')
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1>Liste des utilisateurs</h1>
            <a href="{{ route('users.create') }}"><button class="btn btn-success"><i class="fas fa-plus"></i></button></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-striped table-hover" id="dataTableUser">
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
                                <td scope="col">
                                    @if ($user->tokenRandom)
                                    <a class="btn btn-primary" href="{{ route('users.generate', $user->id) }}" role="button"><i class="fas fa-redo-alt"></i></a> {{ $user->tokenRandom }}
                                    @else
                                    <a class="btn btn-primary" href="{{ route('users.generate', $user->id) }}" role="button"><i class="fas fa-plus"></i></a>
                                    @endif  
                                </td>
                                <td scope="col">
                                    <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}" role="button"><i class="far fa-edit"></i></a>
                                    @if ($user->state == 0)
                                        <a class="btn btn-success" href="{{ route('users.activate', $user->id) }}" role="button"><i class="fas fa-trash-restore"></i></a>
                                    @else
                                        <a class="btn btn-danger" href="{{ route('users.desactivate', $user->id) }}" role="button"><i class="fas fa-trash"></i></a>
                                    @endif
                                </td>
            
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
      </div>
   
    <div class=" mt-2">
        {{ $users->links() }}
    </div>


@endsection
