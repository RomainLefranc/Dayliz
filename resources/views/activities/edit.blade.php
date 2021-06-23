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
        <label for="beginAt" class="form-label">Début</label>
        <input type="datetime-local" class="form-control" name="beginAt" value="{{explode(" ",$activity->beginAt)[0] . "T". explode(" ",$activity->beginAt)[1]}}" placeholder="jj/mm/aaaa hh:mm">
        @if ($errors->has('beginAt'))
            <span>{!! $errors->first('beginAt') !!}</span>
        @endif
    </div>
    <div class="mb-3">
        <label for="endAt" class="form-label">Fin</label>
        <input type="datetime-local" class="form-control" name="endAt" value="{{explode(" ",$activity->endAt)[0] . "T". explode(" ",$activity->endAt)[1]}}" placeholder="jj/mm/aaaa hh:mm">
        @if ($errors->has('endAt'))
            <span>{!! $errors->first('endAt') !!}</span>
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
        <button type="submit" class="btn btn-primary">Modifier</button>
    </div>
</form>

@endsection