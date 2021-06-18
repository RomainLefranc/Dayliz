@extends('layout')

@section('content')

<div class="row">

<h1 class="text-center">Créer un utilisateur</h1>

<form class="row row-cols-2" action="{{route('users.store')}}" method="POST">
@csrf
<div class="form-floating mb-3 col">
  <input type="text" class="form-control" name="lastName" placeholder="Doe">
  <label for="floatingInput">Nom *</label>
</div>
<div class="form-floating mb-3 col">
  <input type="text" class="form-control" name="firstName" placeholder="John">
  <label for="floatingInput">Prénom *</label>
</div>
<div class="form-floating mb-3 col">
  <input type="email" class="form-control" name="email" placeholder="john.doe@mail.com">
  <label for="floatingInput">Email *</label>
</div>
<div class="form-floating mb-3 col">
  <input type="date" class="form-control" name="birthDay">
  <label for="floatingInput">Date de naissance *</label>
</div>
<div class="form-floating mb-3 col">
  <input type="text" class="form-control" name="promotion" placeholder="Simplon 2018-2019">
  <label for="floatingInput">Promotion *</label>
</div>
<div class="form-floating mb-3 col">
  <input type="phone" class="form-control" name="phone" placeholder="069215485">
  <label for="floatingInput">Téléphone *</label>
</div>



<button class="btn btn-primary" type="submit">Créer</button>

</form>


</div>


@endsection