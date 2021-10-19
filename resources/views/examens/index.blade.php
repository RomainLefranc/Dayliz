<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-flex justify-content-between align-items-center">
            Examens
            <a href="{{ route('examens.create') }}"><button class="btn btn-success"><i class="fas fa-plus"></i></button></a>
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
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Date de début</th>
                                    <th scope="col">Date de fin</th>
                                    <th scope="col">Promotion(s)</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($examens as $examen)
                                    <tr>
                                        <td>{{ $examen->id }}</td>
                                        <td>{{ $examen->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($examen->beginAt)->format('d/m/Y à H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($examen->endAt)->format('d/m/Y à H:i') }}</td>
                                        <td>
                                            @if(count($examen->promotions) > 0 )     
                                                    @foreach ($examen->promotions as $promotion)
                                                        <li >
                                                            {{ $promotion->name }}
                                                        </li>
                                                    @endforeach                               
                                            @else 
                                            Aucune promotion
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-primary me-2" href="{{ route('examens.edit', $examen->id) }}" role="button"><i class="far fa-edit"></i></a>
                                            <a class="btn btn-primary me-2" href="{{ route('activities.index', $examen->id) }}" role="button">Déroulé</a>
                                            <form action="{{ route('examens.destroy',$examen->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method("delete")
                                                <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        {{ $examens->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
