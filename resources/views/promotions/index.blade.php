<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-flex justify-content-between align-items-center">
            Promotions
            <a href="{{ route('promotions.create') }}"><button class="btn btn-success "><i class="fas fa-plus"></i></button></a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($promotions as $promotion)
                                <tr>
                                    <td>{{ $promotion->id }}</td>
                                    <td>{{ $promotion->name }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('promotions.edit', $promotion->id) }}" role="button"><i class="far fa-edit"></i></a>
                                        @if ($promotion->state == 0)
                                            <a class="btn btn-success" href="{{ route('promotions.activate', $promotion->id) }}" role="button"><i class="fas fa-trash-restore"></i></a>
                                        @else
                                            <a class="btn btn-danger" href="{{ route('promotions.desactivate', $promotion->id) }}" role="button"><i class="fas fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-2">
                        {{ $promotions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>