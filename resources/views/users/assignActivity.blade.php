@extends('layout')

@section('content')
@if($errors->any())
    <div class="alert alert-danger" role="alert"">
      @foreach ($errors->all() as $error)
        {{ $error }}
      @endforeach
    </div>
@endif
<form method="POST" action={{ route('activities.assign') }}>
@csrf
  <label>Choisir un utilisateur</label>
  <select class="form-select" aria-label="Default select example" name="user_id">
    <option selected>Sélectionner un utilisateur...</option>
    @isset($users)
      @foreach ($users as $user)
        <option value="{{ $user->id }}">{{ $user->firstName }} {{  $user->lastName }}</option>
      @endforeach
    @endisset
   
  </select>

  <label>Attribuer une activité</label>
  <select class="form-select" aria-label="Default select example" name="activity_id">
    <option selected>Sélectionner une activité...</option>
    @isset($activities)
      @foreach ($activities as $activity)
        <option value="{{ $activity->id }}">{{ $activity->title }}</option>
      @endforeach
    @endisset
   
  </select>

    <button type="submit" class="btn btn-primary">Assigner</button>
</form>
@endsection