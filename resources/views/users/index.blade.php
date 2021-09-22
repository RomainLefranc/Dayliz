@extends('layout')
@section('content')
    
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-flex justify-content-between align-items-center ">
            Utilisateurs
            <a href="{{ route('users.create') }}"><button class="btn btn-success"><i class="fas fa-plus"></i></button></a>
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="table-responsive">
                        <table class="table align-middle table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Rôle</th>
                                    <th scope="col">Promotion</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td scope="col">{{ $user->id }}</td>
                                        <td scope="col">{{ $user->firstName }}</td>
                                        <td scope="col">{{ $user->lastName }}</td>
                                        <td scope="col">{{ $user->role->name }}</td>
                                        <td scope="col">
                                            @if ($user->promotion)
                                                {{ $user->promotion->name }}
                                            @else
                                                {{'Aucune promotion'}}
                                            @endif
                                        </td>
                                        <td scope="col">
                                            <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}" role="button"><i class="far fa-edit"></i></a>
                                            @if ($user->state == 0)
                                                <a class="btn btn-success" href="{{ route('users.activate', $user->id) }}" role="button"><i class="fas fa-trash-restore"></i></a>
                                            @else
                                                <a class="btn btn-danger" href="{{ route('users.desactivate', $user->id) }}" role="button"><i class="fas fa-trash"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class=" mt-2">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
