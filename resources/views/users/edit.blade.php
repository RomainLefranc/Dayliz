<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Utilisateurs > {{$user->firstName}} {{$user->lastName}} > édition
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
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
                        <select class="form-control" name="promotion">
                            @foreach ($promotions as $promotion)
                                @if ($user->promotion_id == $promotion->id)
                                    <option value="{{$promotion->id}}" selected>{{$promotion->name}}</option>
                                @else
                                    <option value="{{$promotion->id}}">{{$promotion->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="floatingInput">Promotion *</label>
                    </div>
                    <div class="form-floating mb-3 col">
                        <input type="phone" class="form-control" name="phone"  value="{{$user->phoneNumber}}" required pattern="[0-9]{9}+">
                        <label for="floatingInput">Téléphone *</label>
                    </div>
                    <button class="btn btn-primary" type="submit">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>