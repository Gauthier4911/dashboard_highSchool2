@extends('welcome')

@section('body')
    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-2">
                @include('components.navbar2')
            </div>
            <div class="col-10">
                <form action="{{route('inscription.updateInscription',['id'=>$inscriptions->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="student_id">
                                @foreach($etudiants as $etudiant)
                                    @if($inscriptions->student_id == $etudiant->id)
                                    <option value="{{$etudiant->id}}">
                                        {{$etudiant->nom}} {{$etudiant->prenom}}
                                    </option>
                                    @endif
                                @endforeach
                            @foreach($etudiants as $etudiant)
                                        @if($inscriptions->student_id == $etudiant->id)
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
                        <select class="form-select" aria-label="Default select example" name="salle_id">
                            @foreach($salles as $salle)
                                @if($inscriptions->salle_id == $salle->id)
                                    <option value="{{$salle->id}}">
                                        {{$salle->nom}}
                                    </option>
                                @endif
                            @endforeach
                            @foreach($salles as $salle)
                                @if($inscriptions->salle_id == $salle->id)
                                        <option value="">Choisir une classe</option>
                                    @else
                                        <option value="{{$salle->id}}">{{$salle->nom}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('salle_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="w-100 btn btn-primary">Modifier </button>
                </form>
            </div>
        </section>
    </main>
@endsection
