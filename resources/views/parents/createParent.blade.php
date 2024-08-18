@extends('welcome')


@section('body')
    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-2">
                @include('components.navbar2')
            </div>
            <div class="col-10">
                <div>
                    <h1 class="text-center fw-bold">Listes de tous les parents</h1>
                </div>
                <div>
                    @session('success')
                    <div class="alert alert-success text-center">
                        {{$value}}
                    </div>
                    @endsession
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Ajouter un parent
                    </button>
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('parents.createParent')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="nom" >Nom</label>
                                            <input type="text" class="form-control" name="nom" id="exampleFormControlInput1" placeholder="..." value="{{old('nom')}}">
                                            @error('nom')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="prenom" >Prenom</label>
                                            <input type="text" class="form-control" name="prenom" id="exampleFormControlInput1" placeholder="..." value="{{old('prenom')}}">
                                            @error('prenom')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="adresse">Adresse</label>
                                            <input type="text" class="form-control" name="adresse" id="exampleFormControlInput1" placeholder="..." value="{{old('adresse')}}">
                                            @error('adresse')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" >Email</label>
                                            <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="..." value="{{old('email')}}">
                                            @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="tel" >Telephone</label>
                                            <input type="tel" class="form-control" name="tel" id="exampleFormControlInput1" placeholder="ex: +237658525704" value="{{old('tel')}}">
                                            @error('tel')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="w-100 btn btn-primary">Creer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @forelse($parents as $parent)
                  @empty
                    <p class="mx-1 my-1">Aucun parent ajouter</p>
                @endforelse

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Email</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($parents as $parent)
                            <tr>
                                <td>{{$parent->id}}</td>
                                <td>{{$parent->nom}}</td>
                                <td>{{$parent->prenom}}</td>
                                <td>{{$parent->adresse}}</td>
                                <td>{{$parent->email}}</td>
                                <td>{{$parent->tel}}</td>
                                <td>
                                    <a href="{{route('parents.updateParent',['id'=> $parent->id])}}">
                                        <i class="fas fa-edit text-primary me-3"></i>
                                    </a>
                                    <span data-bs-toggle="modal" data-bs-target="#a{{$parent->id}}" role="button">
                                             <i class="fas fa-trash text-danger"></i>
                                     </span>
                                </td>
                            </tr>
                            <div class="modal fade" id="a{{$parent->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Voulez-vous vraiment supprimer <strong>{{$parent->nom}} {{$parent->prenom}}</strong>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <a href="{{route('parents.delete',['id'=>$parent->id])}}" class="btn btn-danger">Oui</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
@endsection
