@extends('welcome')

@php
    use Illuminate\Support\Str;
@endphp

@section('body')
    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-2">
                @include('components.navbar2')
            </div>
            <div class="col-10">
                <div>
                    <h1 class="text-center fw-bold">Listes  des abscences</h1>
                </div>
                <div>
                    @session('success')
                    <div class="alert alert-success">
                        {{$value}}
                    </div>
                    @endsession
                    <button type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Ajouter une abscence
                    </button>
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('absence.createAbsence')}}" method="post" enctype="multipart/form-data">
                                        @csrf
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
                                        <div class="mb-3">
                                            <select class="form-select" aria-label="Default select example" name="cours_id">
                                                <option value="">Choisir une matière</option>
                                                @foreach($cours as $cour)
                                                    <option value="{{$cour->id}}">{{$cour->matiere}}</option>
                                                @endforeach
                                            </select>
                                            @error('cours_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="date" >Date d'abscence</label>
                                            <input type="date" class="form-control" name="date" id="exampleFormControlInput1" placeholder="jj/mm/aaaa" value="{{old('date')}}">
                                            @error('date')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="motif" >Motif d'abscence</label>
                                            <textarea name="motif" id="motif" cols="3" rows="2" type="text" class="form-control" placeholder="..." >
                                                {{old('motif')}}
                                                @error('motif')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </textarea>
                                        </div>
                                        <div class="mb-3">
                                            Justifié? <br>
                                            <input type="radio" class="form-check-input mx-1" name="justif" id="justif" value="Oui">
                                            <label for="justif" >Oui</label><br>
                                            <input type="radio" class="form-check-input mx-1" name="justif" id="justif" value="Non">
                                            <label for="justif" >Non</label>
                                            @error('justif')
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
                @forelse($heures as $heure)
                @empty
                    <p class="mx-1 my-1">Aucune abscence</p>
                @endforelse
                <form action="{{route('absence.createAbsence')}}" method="get" enctype="multipart/form-data">
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
                            <th scope="col">Etudiant</th>
                            <th scope="col">Cours</th>
                            <th scope="col">Date d'abscence</th>
                            <th scope="col">Justifié?</th>
                            <th scope="col">Motif</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($heures as $heure)
                            <tr>
                                <td>{{$heure->id}}</td>
                                <td>
                                    @foreach($etudiants as $etudiant)
                                        @if($heure->student_id == $etudiant->id)
                                            {{$etudiant->nom}} {{$etudiant->prenom}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($cours as $cour)
                                        @if($heure->cours_id == $cour->id)
                                            {{$cour->matiere}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$heure->date}}</td>
                                <td>{{ Str::substr($heure->motif, 0, 8) }}...</td>
                                <td>
                                    {{$heure->justif}}
                                </td>
                                <td>
                                    <span data-bs-toggle="modal" class="mx-2" data-bs-target="#a1{{$heure->id}}" role="button">
                                             <i class="fas fa-eye text-primary"></i>
                                     </span>
                                    <a href="{{route('absence.updateAbsence',['id'=> $heure->id])}}">
                                        <i class="fas fa-edit text-primary me-3"></i>
                                    </a>
                                    <span data-bs-toggle="modal" data-bs-target="#a{{$heure->id}}" role="button">
                                             <i class="fas fa-trash text-danger"></i>
                                     </span>
                                </td>
                            </tr>
                            <div class="modal fade" id="a{{$heure->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Voulez-vous vraiment supprimer les absences de <strong>

                                                @foreach($etudiants as $etudiant)
                                                    @if($heure->student_id == $etudiant->id)
                                                        {{$etudiant->nom}} {{$etudiant->prenom}}
                                                    @endif
                                                @endforeach

                                            </strong>en <strong>
                                                @foreach($cours as $cour)
                                                    @if($heure->cours_id == $cour->id)
                                                        {{$cour->matiere}}
                                                    @endif
                                                @endforeach
                                            </strong>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <a href="{{route('absence.delete',['id'=>$heure->id])}}" class="btn btn-danger">Oui</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="a1{{$heure->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                           <strong>
                                               {{$heure->motif}}
                                            </strong>
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

