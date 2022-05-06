<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Utilisateurs > création
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="row row-cols-2">
                            <div class="form-floating mb-3 col">
                                <input type="text" class="form-control" name="lastName" placeholder="Doe" required pattern="[A-Za-z-]+">
                                <label for="floatingInput">Nom *</label>
                            </div>
                            <div class="form-floating mb-3 col">
                                <input type="text" class="form-control" name="firstName" placeholder="John" required
                                    pattern="[A-Za-z-]+">
                                <label for="floatingInput">Prénom *</label>
                            </div>
                            <div class="form-floating mb-3 col">
                                <input type="email" class="form-control" name="email" placeholder="john.doe@mail.com" required>
                                <label for="floatingInput">Email *</label>
                            </div>
                            <div class="form-floating mb-3 col">
                                <input type="date" class="form-control" name="birthDay" required  pattern="^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$">
                                <label for="floatingInput">Date de naissance *</label>
                            </div>
                            <div class="form-floating mb-3 col">
                                <select class="form-control" name="promotion">
                                    @foreach ($promotions as $promotion)
                                        <option value="{{$promotion->id}}">{{$promotion->name}}</option>
                                    @endforeach
                                </select>
                                <label for="floatingInput">Promotion *</label>
                            </div>
                            <div class="form-floating mb-3 col">
                                <input type="phone" class="form-control" name="phone" placeholder="069215485" required
                                    pattern="[0-9]{9}+">
                                <label for="floatingInput">Téléphone *</label>
                            </div>
                            <div class="form-floating mb-3 col">
                                <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
                                <label for="floatingInput">Mot de passe *</label>
                            </div>
                            <div class="form-floating mb-3 col">
                                <select class="form-control" name="role">
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                <label for="floatingInput">Rôle</label>
                                {{ Session::get("error") }}
                            </div>
                        </div>
                        <span class="d-flex justify-content-end">
                            <button class="btn btn-primary px-3" type="submit">Créer</button>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
