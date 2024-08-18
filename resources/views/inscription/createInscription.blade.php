@extends('welcome')


@section('body')
    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-2">
                @include('components.navbar2')
            </div>
            <div class="col-10">
                <div>
                    <h1 class="text-center fw-bold">Listes  des inscrits</h1>
                </div>
                <div>
                    @session('success')
                    <div class="alert alert-success">
                        {{$value}}
                    </div>
                    @endsession
                    <button type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Ajouter une inscription
                    </button>
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('inscription.createInscription')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <select class="form-select" aria-label="Default select example" name="salle_id">
                                                <option value="">Choisir une classe</option>
                                                @foreach($salles as $salle)
                                                    <option value="{{$salle->id}}">{{$salle->nom}}</option>
                                                @endforeach
                                            </select>
                                            @error('salle_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select" aria-label="Default select example" name="student_id">
                                                <option value="">Choisir un étudiant</option>
                                                @foreach($etudiants as $etudiant)
                                                    <option value="{{$etudiant->id}}">{{$etudiant->nom}} {{$etudiant->prenom}}</option>
                                                @endforeach
                                            </select>
                                            @error('student_id')
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
                @forelse($inscriptions as $inscription)
                @empty
                    <p class="mx-1 my-1">Aucun etudiant inscrits</p>
                @endforelse
                <form action="{{route('inscription.createInscription')}}" method="get" enctype="multipart/form-data">
                    <div class="mb-3 my-2">
                        <select class="form-select" aria-label="Default select example" name="mot">
                            <option value="">Choisir un étudiant</option>
                            @foreach($etudiants as $etudiant)
                                <option value="{{$etudiant->id}}">{{$etudiant->nom}} {{$etudiant->prenom}}</option>
                            @endforeach
                        </select>
                        @error('mot')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </form>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Classe</th>
                            <th scope="col">Etudiant</th>
                            <th scope="col">Date d'inscription</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($inscriptions as $inscription)
                                <tr>
                                    <td>{{$inscription->id}}</td>
                                    <td>
                                        @foreach($salles as $salle)
                                            @if($inscription->salle_id == $salle->id)
                                                {{$salle->nom}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($etudiants as $etudiant)
                                            @if($inscription->student_id == $etudiant->id)
                                                {{$etudiant->nom}} {{$etudiant->prenom}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{$inscription->created_at}}</td>
                                    <td>
                                        <a href="{{route('inscription.updateInscription',['id'=> $inscription->id])}}">
                                            <i class="fas fa-edit text-primary me-3"></i>
                                        </a>
                                        <span data-bs-toggle="modal" data-bs-target="#a{{$inscription->id}}" role="button">
                                             <i class="fas fa-trash text-danger"></i>
                                     </span>
                                    </td>
                                </tr>
                                <div class="modal fade" id="a{{$inscription->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Voulez-vous vraiment supprimer l'  inscription de <strong>

                                                    @foreach($etudiants as $etudiant)
                                                        @if($inscription->student_id == $etudiant->id)
                                                            {{$etudiant->nom}} {{$etudiant->prenom}}
                                                        @endif
                                                    @endforeach

                                                </strong>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <a href="{{route('inscription.delete',['id'=>$inscription->id])}}" class="btn btn-danger">Oui</a>
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
