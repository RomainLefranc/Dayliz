<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


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