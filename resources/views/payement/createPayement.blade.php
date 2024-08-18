@extends('welcome')


@section('body')
    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-2">
                @include('components.navbar2')
            </div>
            <div class="col-10">
                <div>
                    <h1 class="text-center fw-bold">Listes des payements</h1>
                </div>
                <div>
                    @session('success')
                    <div class="alert alert-success ">
                        {{$value}}
                    </div>
                    @endsession
                    <button type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="fa-solid fa-money-bill mx-1"></i>Ajouter un payement
                    </button>
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('payement.createPayement')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="montant" >Montant</label>
                                            <input type="text" class="form-control" name="montant" id="exampleFormControlInput1" placeholder="..." value="{{old('montant')}}">
                                            @error('montant')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select" aria-label="Default select example" name="methode">
                                                <option value="">methode de payement</option>
                                                <option value="Espece">Espece</option>
                                                <option value="Mobile Money">Mobile Money</option>
                                                <option value="Virement Bancaire">Virement Bancaire</option>
                                            </select>
                                            @error('methode')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select" aria-label="Default select example" name="student_id">
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
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Methode</th>
                            <th scope="col">Etudiant</th>
                            <th scope="col">Date d'inscription</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payements as $payement)
                            <tr>
                                <td>{{$payement->id}}</td>
                                <td>
                                            {{$payement->montant}} FCFA
                                </td>
                                <td>
                                    {{$payement->methode}}
                                </td>
                                <td>
                                    @foreach($etudiants as $etudiant)
                                        @if($payement->student_id == $etudiant->id)
                                            {{$etudiant->nom}} {{$etudiant->prenom}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{$payement->created_at}}
                                </td>
                                <td>
                                    <span data-bs-toggle="modal" data-bs-target="#a{{$payement->id}}" role="button">
                                             <i class="fas fa-trash text-danger"></i>
                                     </span>
                                </td>
                            </tr>
                            <div class="modal fade" id="a{{$payement->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Voulez-vous vraiment supprimer le payement de <strong>

                                                @foreach($etudiants as $etudiant)
                                                    @if($payement->student_id == $etudiant->id)
                                                        {{$etudiant->nom}} {{$etudiant->prenom}}
                                                    @endif
                                                @endforeach

                                            </strong>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <a href="{{route('payement.delete',['id'=>$payement->id])}}" class="btn btn-danger">Oui</a>
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
