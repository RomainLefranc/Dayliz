@extends('layout')

@section('content')
    @include('dataTables')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between">
                <h1>Déroulé de l'examen {{$examen->name}}</h1>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#formCreate">Ajouter</button>
            </div>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
               
        {{-- <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Durée</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($examen->activities as $activity)
                <tr>
                    <td>{{ $activity->id }}</td>
                    <td>{{ $activity->title }}</td>
                    <td>{{ $activity->duree }}</td>
                    <td>{{ $activity->description }}</td>
                    <td class=" d-flex">
                        {{-- @if ($activity->state)
                            <a href="{{ route('activities.desactivate', [$examen->id,$activity->id]) }}">
                                <button class="btn btn-danger">Désactiver</button>
                            </a>
                        @else
                            <a href="{{ route('activities.activate', [$examen->id,$activity->id]) }}">
                                <button class="btn btn-success">Activer</button>
                            </a>
                        @endif --}}
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                        data-bs-target="#formEditModal" data-exam="{{$examen->id}}" data-id="{{ $activity->id }}"
                        onclick="getData(this)">Modifier</button>

                        <form action="{{ route('activities.destroy',[$examen->id,$activity->id]) }}" method="POST">
                            @csrf
                            @method("delete")
                            <button class="btn btn-danger" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table> --}}

        </div>
        <div class="modal fade" id="formCreate" tabindex="-1" aria-labelledby="formLabel" aria-hidden="true">
            <div class="col-12 col-md-6 modal-dialog">
                <div class="col modal-content px-5">
                    <div class="modal-header">
                        <h1>Activité</h1>
                    </div>
                    <form class="" action="{{ route('activities.store', $examen->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title">
                            @error('title')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea type="textarea" class="form-control @error('description') is-invalid @enderror"
                                name="description" rows="3"></textarea>
                            @error('description')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Durée</label>
                            <input type="text" class="form-control @error('duree') is-invalid @enderror" name="duree">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @isset($activity)
            <div class="modal fade" id="formEditModal" tabindex="-1" aria-labelledby="formEditLabel" aria-hidden="true">
                <div class="col-12 col-md-6 modal-dialog">
                    <div class="col modal-content px-5">
                        <div class="modal-header">
                            <h1 id="formEditTitle"></h1>
                        </div>
                        <form id="formEdit" action="{{ route('activities.update', [$examen->id, $activity->id]) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="mb-3">
                                <label for="title" class="form-label">Titre</label>
                                <input id="titleEdit" type="text" class="form-control" name="title" value="">
                                @if ($errors->has('title'))
                                    <span>{ !! $errors->first('title') !! }</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="descriptionEdit" type="textarea" class="form-control" name="description"
                                    rows="3"></textarea>
                                @if ($errors->has('description'))
                                    <span>{ !! $errors->first('description') !! }</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Durée</label>
                                <input id="durationEdit" type="text" class="form-control" name="duree" value="">
                                @if ($errors->has('duree'))
                                    <span>{ !! $errors->first('description') !! }</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endisset
    </div>



    @push('scripts')
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/editModal.js') }}"></script>

    @endpush

@endsection
