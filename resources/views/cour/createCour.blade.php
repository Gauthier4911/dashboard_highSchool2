@extends('welcome')


@section('body')
    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-2">
                @include('components.navbar2')
            </div>
            <div class="col-10">
                <div>
                    <h1 class="text-center fw-bold">Listes des cours</h1>
                </div>
                <div>
                    @session('success')
                    <div class="alert alert-success">
                        {{$value}}
                    </div>
                    @endsession
                    <button type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Ajouter un cour
                    </button>
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('cour.createCour')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="matiere" >Nom de la matière</label>
                                            <input type="text" class="form-control" name="matiere" id="exampleFormControlInput1" placeholder="..." value="{{old('matiere')}}">
                                            @error('matiere')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="heure" >Heure</label>
                                            <input type="time" class="form-control" name="heure" id="exampleFormControlInput1" placeholder="00:00" value="{{old('heure')}}">
                                            @error('heure')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="date" >Jour(s) de la semaine(s)</label>
                                            <input type="text" class="form-control" name="date" id="exampleFormControlInput1" placeholder="ex: Lundi,Mardi,Vendredi..." value="{{old('date')}}">
                                            @error('date')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select" aria-label="Default select example" name="teacher_id">
                                                <option value="">Choisir un enseignant</option>
                                                @foreach($teachers as $teacher)
                                                    <option value="{{$teacher->id}}">{{$teacher->nom}} {{$teacher->prenom}}</option>
                                                @endforeach
                                            </select>
                                            @error('teacher_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
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
                                        <button type="submit" class="w-100 btn btn-primary">Creer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @forelse($cours as $cour)
                @empty
                    <p class="mx-1 my-1">Aucun programme de cour disponible</p>
                @endforelse
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Matière</th>
                            <th scope="col">Horaire</th>
                            <th scope="col">Jour</th>
                            <th scope="col">Classe</th>
                            <th scope="col">Enseignants</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cours as $cour)
                            <tr>
                                <td>{{$cour->id}}</td>
                                <td>{{$cour->matiere}}</td>
                                <td>{{$cour->heure}}</td>
                                <td>{{$cour->date}}</td>
                                <td>
                                    @foreach($salles as $salle)
                                        @if($cour->salle_id == $salle->id)
                                            {{$salle->nom}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>

                                    @foreach($teachers as $teacher)
                                        @if($cour->teacher_id == $teacher->id)
                                            {{$teacher->nom}} {{$teacher->prenom}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{route('cour.updateCour',['id'=> $cour->id])}}">
                                        <i class="fas fa-edit text-primary me-3"></i>
                                    </a>
                                    <span data-bs-toggle="modal" data-bs-target="#a{{$cour->id}}" role="button">
                                             <i class="fas fa-trash text-danger"></i>
                                     </span>
                                </td>
                            </tr>
                            <div class="modal fade" id="a{{$cour->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Voulez-vous vraiment supprimer le programme de cour de Mr/Mme <strong>

                                                @foreach($teachers as $teacher)
                                                    @if($cour->teacher_id == $teacher->id)
                                                        {{$teacher->nom}} {{$teacher->prenom}}
                                                    @endif
                                                @endforeach

                                            </strong>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <a href="{{route('cour.delete',['id'=>$cour->id])}}" class="btn btn-danger">Oui</a>
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
