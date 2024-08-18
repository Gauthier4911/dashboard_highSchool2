@extends('welcome')

@section('body')
    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-2">
                @include('components.navbar2')
            </div>
            <div class="col-10">
                <form action="{{route('absence.updateAbsence',['id'=>$heures->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <select  class="form-select" aria-label="Default select example" name="student_id">
                            @foreach($etudiants as $etudiant)
                                @if($heures->student_id == $etudiant->id)
                                    <option value="{{$etudiant->id}}">
                                        {{$etudiant->nom}} {{$etudiant->prenom}}
                                    </option>
                                @endif
                            @endforeach
                            @foreach($etudiants as $etudiant)
                                @if($heures->student_id == $etudiant->id)
                                    <option value="">Choisir un etudiant</option>
                                @else
                                    <option value="{{$etudiant->id}}">{{$etudiant->nom}} {{$etudiant->prenom}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('student_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select  class="form-select" aria-label="Default select example" name="cours_id">
                            @foreach($cours as $cour)
                                @if($heures->cours_id == $cour->id)
                                    <option value="{{$cour->id}}">
                                        {{$cour->matiere}}
                                    </option>
                                @endif
                            @endforeach
                            @foreach($cours as $cour)
                                @if($heures->cours_id == $cour->id)
                                    <option value="">Choisir une matiere</option>
                                @else
                                    <option value="{{$cour->id}}">{{$cour->matiere}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('cours_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date" >Date d'abscence</label>
                        <input type="date" class="form-control" name="date" id="exampleFormControlInput1" placeholder="jj/mm/aaaa" value="{{$heures->date}}">
                        @error('date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="motif" >Motif d'abscence</label>
                        <textarea name="motif" id="motif" cols="3" rows="2" type="text" class="form-control" placeholder="..." >
                                                {{$heures->motif}}
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
                    <button type="submit" class="w-100 btn btn-primary">Modifier</button>
                </form>
            </div>
        </section>
    </main>
@endsection
