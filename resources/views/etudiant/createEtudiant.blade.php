@extends('welcome')


@section('body')
    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-2">
                @include('components.navbar2')
            </div>
            <div class="col-10">
                <div>
                    <h1 class="text-center fw-bold">Listes de tous des etudiants</h1>
                </div>
                <div>
                    @session('success')
                    <div class="alert alert-success">
                        {{$value}}
                    </div>
                    @endsession
                    <button type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="fa-solid fa-graduation-cap mx-1"></i> Ajouter un etudiant
                    </button>
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('etudiant.createEtudiant')}}" method="post" enctype="multipart/form-data">
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
                                            <label for="date" >Date de naissance</label>
                                            <input type="date" class="form-control" name="date" id="exampleFormControlInput1" placeholder="jj/mm/aaaa" value="{{old('date')}}">
                                            @error('date')
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
                                        <div class="mb-3">
                                            <select class="form-select" aria-label="Default select example" name="parent_id">
                                                <option value="">Choisir un parent</option>
                                                @foreach($parents as $parent)
                                                <option value="{{$parent->id}}">{{$parent->nom}} {{$parent->prenom}}</option>
                                                @endforeach
                                            </select>
                                            @error('parent')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="file" >Image</label>
                                            <input type="file" class="form-control" name="file" accept="image/*">
                                            @error('file')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="w-100 btn btn-primary">Creer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @forelse($etudiants as $etudiant)
                @empty
                    <p class="mx-1 my-1">Pas d'etudiant disponibe</p>
                @endforelse
                <form action="{{ route('etudiant.search') }}" method="get">
                    @csrf
                    <div class="mb-3 my-1">
                        <input name="mot" type="text" class="form-control w-100" placeholder="Taper le nom d'un étudiant...">
                    </div>
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </form>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Naissance</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Email</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col">Tranche</th>
                            <th scope="col">Parent</th>
                            <th scope="col">Image</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($etudiants->count()>0)
                            @foreach($etudiants as $etudiant)
                            <tr>
                                <td>{{$etudiant->id}}</td>
                                <td>{{$etudiant->nom}}</td>
                                <td>{{$etudiant->prenom}}</td>
                                <td>{{$etudiant->date}}</td>
                                <td>{{$etudiant->adresse}}</td>
                                <td>{{$etudiant->email}}</td>
                                <td>{{$etudiant->tel}}</td>
                                <td>
                                    @if(is_null($etudiant->hasCompletedPayment()))
                                        <!-- Afficher un champ vide si le montant total est 0 -->
                                        <span></span>
                                    @elseif($etudiant->hasCompletedPayment())
                                        <span class="badge bg-success">Fini</span>
                                    @else
                                        <span class="badge bg-danger">Reste</span>
                                    @endif

                                </td>
                                <td>
                                    @foreach($parents as $parent)
                                        @if($etudiant->parent_id == $parent->id)
                                            {{$parent->nom}} {{$parent->prenom}}
                                        @endif
                                    @endforeach
                                    </td>
                                <td><img src="{{asset('storage/imageEtu/'.$etudiant->image)}}" alt="" width="50" height="50"></td>
                                <td>
                                    <a href="{{route('etudiant.updateEtudiant',['id'=> $etudiant->id])}}">
                                        <i class="fas fa-edit text-primary me-3"></i>
                                    </a>
                                    <span data-bs-toggle="modal" data-bs-target="#a{{$etudiant->id}}" role="button">
                                             <i class="fas fa-trash text-danger"></i>
                                     </span>
                                </td>
                            </tr>
                            <div class="modal fade" id="a{{$etudiant->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Voulez-vous vraiment supprimer <strong>{{$etudiant->nom}} {{$etudiant->prenom}}</strong>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <a href="{{route('etudiant.delete',['id'=>$etudiant->id])}}" class="btn btn-danger">Oui</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                            <p>Pas d'étudiants trouvé </p>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
@endsection
