<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Promotions > {{$promotion->name}} > édition
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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
                            <input type="text" class="form-control" name="name" placeholder="Doe" value="{{$promotion->name}}">
                            <label for="floatingInput">Nom *</label>
                        </div>
                        <button class="btn btn-primary" type="submit">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>