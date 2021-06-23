@extends('layout')


@section('content')

<h1>Activités de l'apprenant </h1>

@foreach ($activities as $activity)
    <p>{{$activity->title}}</p>
@endforeach

@endsection