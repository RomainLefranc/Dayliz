@extends('layout')

@section('content')

    <div class="row">
        <h1 class="text-center">Modifier une promotion</h1>

        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <form action="{{ route('promotions.update',$promotion->id) }}" method="POST">
            @csrf
            @method("patch")
            <div class="form-floating mb-3 col">
                <input type="text" class="form-control" name="name" placeholder="Doe" value="{{$promotion->name}}" required pattern="[A-Za-z-]+">
                <label for="floatingInput">Nom *</label>
            </div>
            <button class="btn btn-primary" type="submit">Modifier</button>
        </form>
    </div>


@endsection
