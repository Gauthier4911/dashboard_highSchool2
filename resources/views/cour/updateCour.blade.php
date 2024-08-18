@extends('welcome')

@section('body')
    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-2">
                @include('components.navbar2')
            </div>
            <div class="col-10">
                <form action="{{route('cour.updateCour',['id'=>$cours->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="matiere" >Nom de la matière</label>
                        <input type="text" class="form-control" name="matiere" id="exampleFormControlInput1" placeholder="..." value="{{$cours->matiere}}">
                        @error('matiere')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="heure" >Heure</label>
                        <input type="time" class="form-control" name="heure" id="exampleFormControlInput1" placeholder="00:00" value="{{$cours->heure}}">
                        @error('heure')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date" >Jour(s) de la semaine(s)</label>
                        <input type="text" class="form-control" name="date" id="exampleFormControlInput1" placeholder="ex: Lundi,Mardi,Vendredi..." value="{{$cours->date}}">
                        @error('date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="teacher_id">
                            @foreach($teachers as $teacher)
                                @if($cours->teacher_id == $teacher->id)
                                    <option value="{{$teacher->id}}">
                                        {{$teacher->nom}} {{$teacher->prenom}}
                                    </option>
                                @endif
                            @endforeach
                            @foreach($teachers as $teacher)
                                @if($cours->teacher_id == $teacher->id)
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
                        <select class="form-select" aria-label="Default select example" name="salle_id">
                            @foreach($salles as $salle)
                                @if($cours->salle_id == $salle->id)
                                    <option value="{{$salle->id}}">
                                        {{$salle->nom}}
                                    </option>
                                @endif
                            @endforeach
                            @foreach($salles as $salle)
                                @if($cours->salle_id == $salle->id)
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
                    <button type="submit" class="w-100 btn btn-primary">Modifier le cour</button>
                </form>
            </div>
        </section>
    </main>
@endsection
