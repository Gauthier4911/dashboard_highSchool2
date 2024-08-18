@extends('welcome')

@section('body')
    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-2">
                @include('components.navbar2')
            </div>
            <div class="col-10">
                <form action="{{route('pages.updateClasse',['id'=>$salles->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nom" >Nom de la classe</label>
                        <input type="text" class="form-control" name="nom" id="exampleFormControlInput1" placeholder="..." value="{{$salles->nom}}">
                        @error('nom')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="cycle">
                            <option value="1er cycle">1er cycle</option>
                            <option value="2nd cycle">2nd cycle</option>
                        </select>
                        @error('cycle')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="w-100 btn btn-primary">Modifier cette classe</button>
                </form>
            </div>
        </section>
    </main>
@endsection
