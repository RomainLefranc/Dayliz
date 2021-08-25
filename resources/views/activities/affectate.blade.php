@extends('layout')

@section('content')

<h1>{{$activity->title}}</h1>

<form action={{route('activities.affecte',[$activity->id,$idexamen])}} method="POST">
    @csrf
    <select class="form-control" name="user">
        @foreach($users as $user)
        <option value={{$user->id}}> {{$user->firstName}} {{$user->lastName}}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary mt-2">Affecter</button>
</form>


@endsection