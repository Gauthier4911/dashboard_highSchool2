@extends('welcome')

@section('body')
    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-2">
                @include('components.navbar2')
            </div>
            <div class="col-10">
                <form action="{{route('parents.updateParent',['id'=>$parents->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nom" >Nom</label>
                        <input type="text" class="form-control" name="nom" id="exampleFormControlInput1" placeholder="..." value="{{$parents->nom}}">
                        @error('nom')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="prenom" >Prenom</label>
                        <input type="text" class="form-control" name="prenom" id="exampleFormControlInput1" placeholder="..." value="{{$parents->prenom}}">
                        @error('prenom')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="adresse">Adresse</label>
                        <input type="text" class="form-control" name="adresse" id="exampleFormControlInput1" placeholder="..." value="{{$parents->adresse}}">
                        @error('adresse')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" >Email</label>
                        <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="..." value="{{$parents->email}}">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tel" >Telephone</label>
                        <input type="tel" class="form-control" name="tel" id="exampleFormControlInput1" placeholder="ex: +237658525704" value="{{$parents->tel}}">
                        @error('tel')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="w-100 btn btn-primary">Modifier ce parent</button>
                </form>
            </div>
        </section>
    </main>
@endsection
