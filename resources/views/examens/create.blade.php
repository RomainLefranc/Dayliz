@extends('layout')

@section('content')

    <div class="row">
        <h1 class="text-center">Créer un examen</h1>
        <form action="{{ route('examens.store') }}" method="POST">
            @csrf
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control" name="name" placeholder="Doe" required pattern="[A-Za-z-]+">
                <label for="floatingInput">Nom *</label>
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
                <select class="form-control" name="promotion[]" multiple>
                    @foreach ($promotions as $promotion)
                        <option value="{{$promotion->id}}">{{$promotion->name}}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Ajouter</button>
        </form>
    </div>


@endsection
