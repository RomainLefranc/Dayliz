@extends('layout')
@section('content')

    <div class="d-flex justify-content-between align-items-center">
        <h1>Liste des utilisateurs</h1>
        <a href="{{ route('users.create') }}"><button class="btn btn-success">Ajouter</button></a>
    </div>

    <table class="table table-bordered table-striped table-hover" id="dataTableUser">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Rôle</th>
                <th scope="col">Promotion</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
    </table>


  @push('scripts')
  <script src="{{ asset('js/dataTable.js') }}"></script>
  @endpush
@endsection
