@extends('welcome')

@section('body')
    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-2">
                @include('components.navbar2')
            </div>
            <div class="col-3">
                <img src="{{asset('storage/imageTea/'.$teachers->image)}}" style="width: 300px;height: 200px" alt="">
            </div>
            <div class="col-4">
                <form action="{{route('enseignant.updateEnseignant',['id'=>$teachers->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nom" >Nom</label>
                        <input type="text" class="form-control" name="nom" id="exampleFormControlInput1" placeholder="..." value="{{$teachers->nom}}">
                        @error('nom')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="prenom" >Prenom</label>
                        <input type="text" class="form-control" name="prenom" id="exampleFormControlInput1" placeholder="..." value="{{$teachers->prenom}}">
                        @error('prenom')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date" >Date de naissance</label>
                        <input type="date" class="form-control" name="date" id="exampleFormControlInput1" placeholder="jj/mm/aaaa" value="{{$teachers->date}}">
                        @error('date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="adresse">Adresse</label>
                        <input type="text" class="form-control" name="adresse" id="exampleFormControlInput1" placeholder="..." value="{{$teachers->adresse}}">
                        @error('adresse')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" >Email</label>
                        <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="..." value="{{$teachers->email}}">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tel" >Telephone</label>
                        <input type="tel" class="form-control" name="tel" id="exampleFormControlInput1" placeholder="ex: +237658525704" value="{{$teachers->tel}}">
                        @error('tel')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="matiere">Matière</label>
                        <input type="text" class="form-control" name="matiere" id="exampleFormControlInput1" placeholder="..." value="{{$teachers->matiere}}">
                        @error('matiere')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date2" >Date d'embauche</label>
                        <input type="date" class="form-control" name="date2" id="exampleFormControlInput1" placeholder="jj/mm/aaaa" value="{{$teachers->date2}}">
                        @error('date2')
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
                    <button type="submit" class="w-100 btn btn-primary">Modifier</button>
                </form>
            </div>
            <div class="col-3">
                        <h2 class="text-center fw-bold my-2"><u>Son programme de cours</u></h2>
                            @foreach($cours as $cour)
                                @if($cour->teacher_id == $teachers->id)
                                    <ul class="my-2">
                                        <li>
                                            <strong>
                                                @foreach($salles as $salle)
                                                    @if($cour->salle_id == $salle->id)
                                                        {{$salle->nom}}
                                                    @endif
                                                @endforeach
                                            </strong> à {{$cour->heure}} {{$cour->matiere}} les {{$cour->date}}
                                            <hr>
                                        </li>
                                    </ul>
                    @else
                        <p class="my-2"><strong>Pas de programme disponible !!!</strong></p><hr>
                                @endif
                            @endforeach
            </div>
        </section>
    </main>
@endsection
