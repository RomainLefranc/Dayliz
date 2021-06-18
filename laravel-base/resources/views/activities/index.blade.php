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
                    <input type="text" class="form-control" name="title" value="Titre">
                    @if ($errors->has('title'))
                        <span>{ !! $errors->first('title') !! }</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="beginAt" class="form-label">Début</label>
                    <input type="datetime-local" class="form-control" name="beginAt" value="18/06/2021 13:00">
                    @if ($errors->has('beginAt'))
                        <span>{!! $errors->first('beginAt') !!}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="endAt" class="form-label">Fin</label>
                    <input type="datetime-local" class="form-control" name="endAt" value="18/06/2021 14:00">
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

@endsection