@extends('layout')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            <h1>Liste des activités</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form">Ajouter</button>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Date début</th>
                    <th scope="col">Date Fin</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $activity)
                <tr>
                    <td>{{ $activity->id }}</td>
                    <td>{{ $activity->title }}</td>
                    <td>{{ date('d/m/Y à H:i', strtotime($activity->beginAt))}}</td>
                    <td>{{ date('d/m/Y à H:i', strtotime($activity->endAt)) }}</td>
                    <td>
                        @if ($activity->state)
                        <a href="activity/desactivate/{{ $activity->id }}">
                            <button class="btn btn-danger">Désactiver</button>
                        </a>
                        @else
                        <a href="activity/activate/{{ $activity->id }}">
                            <button class="btn btn-success">Activer</button>
                        </a>
                        @endif
                        <a href="{{ route('activities.edit', $activity->id) }}">
                            <button class="btn btn-primary">Modifier</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>



    </div>
    <div class="modal fade" id="form" tabindex="-1" aria-labelledby="formLabel" aria-hidden="true">
        <div class="col-12 col-md-6 modal-dialog">
            <div class="col modal-content px-5">
                <div class="modal-header">
                    <h1>Activité</h1>
                </div>
                <form class="" action="{{ route('activities.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" class="form-control" name="title" value="Titre">
                        @if ($errors->has('title'))
                        <span>{ !! $errors->first('title') !! }</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="beginAt" class="form-label">Début</label>
                        <input type="datetime-local" class="form-control" name="beginAt" placeholder="jj/mm/aaaa hh:mm">
                        @if ($errors->has('beginAt'))
                        <span>{!! $errors->first('beginAt') !!}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="endAt" class="form-label">Fin</label>
                        <input type="datetime-local" class="form-control" name="endAt" placeholder="jj/mm/aaaa hh:mm">
                        @if ($errors->has('endAt'))
                        <span>{!! $errors->first('endAt') !!}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea type="textarea" class="form-control" name="description" rows="3"></textarea>
                        @if ($errors->has('description'))
                        <span>{ !! $errors->first('description') !! }</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection