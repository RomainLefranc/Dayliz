@extends('layout')
@section('content')



<div class="row">

    <h1 class="text-center">Modifier l'utilisateur : {{$user->firstName}} {{$user->lastName}}</h1>
 
    <form class="row row-cols-2" action="{{ route('users.update',$user->id) }}" method="POST">
        @csrf
        @method('patch')
        <div class="form-floating mb-3 col">
            <input type="text" class="form-control" name="lastName" value="{{$user->lastName}}" required pattern="[A-Za-z-]+">
            <label for="floatingInput">Nom *</label>
        </div>
        <div class="form-floating mb-3 col">
            <input type="text" class="form-control" name="firstName"  value="{{$user->firstName}}" placeholder="John" required pattern="[A-Za-z-]+">
            <label for="floatingInput">Prénom *</label>
        </div>
        <div class="form-floating mb-3 col">
            <input type="email" class="form-control" name="email"  value="{{$user->email}}" placeholder="john.doe@mail.com" required>
            <label for="floatingInput">Email *</label>
        </div>
        <div class="form-floating mb-3 col">
            <input type="date" class="form-control" name="birthDay" required  value="{{$user->birthDay}}">
            <label for="floatingInput">Date de naissance *</label>
        </div>
        <div class="form-floating mb-3 col">
            <input type="text" class="form-control" name="promotion"  value="{{$user->promotion}}" required
                pattern="[A-Za-z-0-9 ]+">
            <label for="floatingInput">Promotion *</label>
        </div>
        <div class="form-floating mb-3 col">
            <input type="phone" class="form-control" name="phone"  value="{{$user->phoneNumber}}" required pattern="[0-9]{9}+">
            <label for="floatingInput">Téléphone *</label>
        </div>



        <button class="btn btn-primary" type="submit">Modifier</button>

    </form>


</div>

@endsection