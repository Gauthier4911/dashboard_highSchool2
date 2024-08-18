@extends('welcome')

@section('body')
    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-2">
                @include('components.navbar2')
            </div>
            <div class="col-10">
                <form action="{{route('note.updateNote',['id'=>$notes->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <select  class="form-select" aria-label="Default select example" name="student_id">
                            @foreach($etudiants as $etudiant)
                                @if($notes->student_id == $etudiant->id)
                                    <option value="{{$etudiant->id}}">
                                        {{$etudiant->nom}} {{$etudiant->prenom}}
                                    </option>
                                @endif
                            @endforeach
                            @foreach($etudiants as $etudiant)
                                @if($notes->student_id == $etudiant->id)
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
                        <select  class="form-select" aria-label="Default select example" name="teacher_id">
                            @foreach($teachers as $teacher)
                                @if($notes->teacher_id == $teacher->id)
                                    <option value="{{$teacher->id}}">
                                        {{$teacher->nom}} {{$teacher->prenom}}
                                    </option>
                                @endif
                            @endforeach
                            @foreach($teachers as $teacher)
                                @if($notes->teacher_id == $teacher->id)
                                    <option value="">Choisir un enseignant</option>
                                @else
                                    <option value="{{$teacher->id}}">{{$teacher->nom}} {{$teacher->prenom}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('teacher_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select  class="form-select" aria-label="Default select example" name="cours_id">
                            @foreach($cours as $cour)
                                @if($notes->cours_id == $cour->id)
                                    <option value="{{$cour->id}}">
                                        {{$cour->matiere}}
                                    </option>
                                @endif
                            @endforeach
                            @foreach($cours as $cour)
                                @if($notes->cours_id == $cour->id)
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
                        <label for="moy" >Entrer la note</label>
                        <input type="number" class="form-control" name="moy" id="exampleFormControlInput1" placeholder="..." value="{{$notes->moy}}">
                        @error('moy')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="w-100 btn btn-primary">Modifier la note</button>
                </form>
            </div>
        </section>
    </main>
@endsection
