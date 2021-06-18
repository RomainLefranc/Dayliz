@extends('layout')

@section('content')

    <div class="row">

        <h1 class="text-center">Créer un utilisateur</h1>

        <form class="row row-cols-2" action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control" name="lastName" placeholder="Doe" required pattern="[A-Za-z-]+">
                <label for="floatingInput">Nom *</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control" name="firstName" placeholder="John" required pattern="[A-Za-z-]+">
                <label for="floatingInput">Prénom *</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="email" class="form-control" name="email" placeholder="john.doe@mail.com" required>
                <label for="floatingInput">Email *</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="date" class="form-control" name="birthDay" required>
                <label for="floatingInput">Date de naissance *</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control" name="promotion" placeholder="Simplon 2018-2019" required
                    pattern="[A-Za-z-0-9 ]+">
                <label for="floatingInput">Promotion *</label>
            </div>
            <div class="form-floating mb-3 col">
                <input type="phone" class="form-control" name="phone" placeholder="069215485" required pattern="[0-9]{9}+">
                <label for="floatingInput">Téléphone *</label>
            </div>



            <button class="btn btn-primary" type="submit">Créer</button>

        </form>


    </div>


@endsection