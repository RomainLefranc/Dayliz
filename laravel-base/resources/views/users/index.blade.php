<a href="/users/create">Aller au formulaire de création d'utilisateurs</a>

@foreach ($users as $user)
   <a href="{{ route('users.edit',$user->id)}}"> {{$user->lastName}} </a>
@endforeach