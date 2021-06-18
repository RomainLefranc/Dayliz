@extends('layout')

@section('content')

<div class="row">
    <div class="col-12 col-md-6"></div>
    <div class="col-12 col-md-6">
        <div class="col">
            <h1>Activité</h1>
            <form class="" action="{{ route('activities.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="mb-3">
                    <label for="beginAt" class="form-label">Début</label>
                    <input type="datetime-local" class="form-control" name="beginAt">
                </div>
                <div class="mb-3">
                    <label for="endAt" class="form-label">Fin</label>
                    <input type="datetime-local" class="form-control" name="endAt">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea type="textarea" class="form-control" name="description" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
        </div>
        </form>
    </div>
</div>