@extends('layout')

@section('content')

    <div class="row">
        <h1 class="text-center">Modifier un examen</h1>
        <form action="{{ route('examens.update',$examen->id) }}" method="POST">
            @csrf
            @method("patch")
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control" name="name" placeholder="Doe" value="{{ $examen->name }}" required pattern="[A-Za-z-]+">
                <label for="floatingInput">Nom *</label>
            </div>
            <div class="mb-3">
                <label for="beginAt" class="form-label">Début</label>
                <input type="datetime-local" class="form-control @error('beginAt') is-invalid @enderror" name="beginAt" value="{{  \Carbon\Carbon::parse($examen->beginAt)->format('Y-m-d\TH:i') }}" placeholder="jj/mm/aaaa hh:mm">
                @error('beginAt')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="endAt" class="form-label">Fin</label>
                <input type="datetime-local" class="form-control @error('endAt') is-invalid @enderror" name="endAt" value="{{  \Carbon\Carbon::parse($examen->endAt)->format('Y-m-d\TH:i') }}" placeholder="jj/mm/aaaa hh:mm">
                @error('endAt')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <select class="form-control" name="promotion[]" multiple>
                    @foreach ($promotions as $promotion)
                        @if (in_array($promotion->id,$cur_ids))
                            <option value="{{$promotion->id}}" selected>{{$promotion->name}}</option>
                        @else
                            <option value="{{$promotion->id}}">{{$promotion->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Modifier</button>
        </form>
    </div>


@endsection
