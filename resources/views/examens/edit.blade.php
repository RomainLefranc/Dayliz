<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Examens > {{ $examen->name }} > édition
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('examens.update',$examen->id) }}" method="POST">
                        @csrf
                        @method("patch")
                        <div class="form-floating mb-3 col">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Doe" value="{{ $examen->name }}" >
                            <label for="floatingInput">Nom *</label>
                            @error('name')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="beginAt" class="form-label">Début</label>
                            <input type="datetime-local" class="form-control @error('beginAt') is-invalid @enderror" name="beginAt" value="{{ \Carbon\Carbon::parse($examen->beginAt)->format('Y-m-d H:i') }}" placeholder="jj/mm/aaaa hh:mm">
                            @error('beginAt')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="endAt" class="form-label">Fin</label>
                            <input type="datetime-local" class="form-control @error('endAt') is-invalid @enderror" name="endAt" value="{{ \Carbon\Carbon::parse($examen->endAt)->format('Y-m-d H:i')}}" placeholder="jj/mm/aaaa hh:mm">
                            @error('endAt')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <select class="form-control @error('promotion') is-invalid @enderror" name="promotion[]" multiple>
                                @foreach ($promotions as $promotion)
                                    @if (in_array($promotion->id,$cur_ids))
                                        <option value="{{$promotion->id}}" selected>{{$promotion->name}}</option>
                                    @else
                                        <option value="{{$promotion->id}}">{{$promotion->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('promotion')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>