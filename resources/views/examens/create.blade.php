<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Examens > création
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('examens.store') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3 col">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Doe">
                            <label for="floatingInput">Nom *</label>
                            @error('name')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="beginAt" class="form-label">Début *</label>
                            <input type="datetime-local" class="form-control @error('beginAt') is-invalid @enderror" name="beginAt" placeholder="jj/mm/aaaa hh:mm">
                            @error('beginAt')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="endAt" class="form-label">Fin *</label>
                            <input type="datetime-local" class="form-control @error('endAt') is-invalid @enderror" name="endAt" placeholder="jj/mm/aaaa hh:mm">
                            @error('endAt')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="promotion" class="form-label">Promotion(s) *</label>
                            <select class="form-control @error('promotion') is-invalid @enderror" name="promotion[]" multiple>
                                @foreach ($promotions as $promotion)
                                    <option value="{{$promotion->id}}">{{$promotion->name}}</option>
                                @endforeach
                            </select>
                            @error('promotion')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
