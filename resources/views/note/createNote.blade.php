@extends('welcome')


@section('body')
    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-2">
                @include('components.navbar2')
            </div>
            <div class="col-10">
                <div>
                    <h1 class="text-center fw-bold">Listes  des notes</h1>
                </div>
                <div>
                    @session('success')
                    <div class="alert alert-success">
                        {{$value}}
                    </div>
                    @endsession
                    <button type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Ajouter une note
                    </button>
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('note.createNote')}}" method="post" enctype="multipart/form-data">
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
                                            <select class="form-select" aria-label="Default select example" name="teacher_id">
                                                <option value="">Choisir un enseignants</option>
                                                @foreach($teachers as $teacher)
                                                    <option value="{{$teacher->id}}">{{$teacher->nom}} {{$teacher->prenom}}</option>
                                                @endforeach
                                            </select>
                                            @error('teacher_id')
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
                                            <label for="moy" >Note</label>
                                            <input type="number" class="form-control" name="moy" id="exampleFormControlInput1" placeholder="10.00" value="{{old('moy')}}">
                                            @error('moy')
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
                @forelse($notes as $note)
                @empty
                    <p class="mx-1 my-1">Aucune note</p>
                @endforelse
                <form action="{{route('note.createNote')}}" method="get" enctype="multipart/form-data">
                    <div class="mb-3 my-2">
                        <select class="form-select" aria-label="Default select example" name="mot">
                            <option value="">Choisir un étudiant</option>
                            @foreach($inscriptions as $inscription)
                                <option value="{{$inscription->student_id}}">

                                    @foreach($etudiants as $etudiant)
                                        @if($inscription->student_id == $etudiant->id)
                                            {{$etudiant->nom}} {{$etudiant->prenom}}
                                        @endif
                                    @endforeach

                                </option>
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
                            <th scope="col">Note</th>
                            <th scope="col">Enseignant</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($notes as $note)
                            <tr>
                                <td>{{$note->id}}</td>
                                <td>
                                    @foreach($etudiants as $etudiant)
                                        @if($note->student_id == $etudiant->id)
                                            {{$etudiant->nom}} {{$etudiant->prenom}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($cours as $cour)
                                        @if($note->cours_id == $cour->id)
                                            {{$cour->matiere}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$note->moy}}</td>
                                <td>
                                    @foreach($teachers as $teacher)
                                        @if($note->teacher_id == $teacher->id)
                                            {{$teacher->nom}} {{$teacher->prenom}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{route('note.updateNote',['id'=> $note->id])}}">
                                        <i class="fas fa-edit text-primary me-3"></i>
                                    </a>
                                    <span data-bs-toggle="modal" data-bs-target="#a{{$note->id}}" role="button">
                                             <i class="fas fa-trash text-danger"></i>
                                     </span>
                                </td>
                            </tr>
                            <div class="modal fade" id="a{{$note->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Voulez-vous vraiment supprimer la note de <strong>

                                                @foreach($etudiants as $etudiant)
                                                    @if($note->student_id == $etudiant->id)
                                                        {{$etudiant->nom}} {{$etudiant->prenom}}
                                                    @endif
                                                @endforeach

                                            </strong>en <strong>
                                                @foreach($cours as $cour)
                                                    @if($note->cours_id == $cour->id)
                                                        {{$cour->matiere}}
                                                    @endif
                                                @endforeach
                                            </strong>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <a href="{{route('note.delete',['id'=>$note->id])}}" class="btn btn-danger">Oui</a>
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
