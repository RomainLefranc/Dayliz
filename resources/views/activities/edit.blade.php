@extends('layout')
@section('content')

Modifier l'activité {{$activity->title}}

<form class="" action="{{ route('activities.update',$activity->id) }}" method="POST">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" class="form-control" name="title" value="{{$activity->title}}">
        @if ($errors->has('title'))
            <span>{ !! $errors->first('title') !! }</span>
        @endif
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea type="textarea" class="form-control" name="description" rows="3">{{$activity->description}}</textarea>
        @if ($errors->has('description'))
            <span>{ !! $errors->first('description') !! }</span>
        @endif
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" name="duree" value="{{$activity->duree}}">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Modifier</button>
    </div>
</form>

@endsection