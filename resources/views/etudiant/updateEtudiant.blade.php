@extends('welcome')

@php
    use Carbon\Carbon;
@endphp

@section('body')
    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-2">
                @include('components.navbar2')
            </div>
            <div class="col-3">
                <img src="{{ asset('storage/imageEtu/' . $etudiants->image) }}" style="width: 300px; height: 200px" alt="">
            </div>
            <div class="col-4">
                <form action="{{ route('etudiant.updateEtudiant', ['id' => $etudiants->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" name="nom" id="exampleFormControlInput1" placeholder="..." value="{{ $etudiants->nom }}">
                        @error('nom')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="prenom">Prenom</label>
                        <input type="text" class="form-control" name="prenom" id="exampleFormControlInput1" placeholder="..." value="{{ $etudiants->prenom }}">
                        @error('prenom')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date">Date de naissance</label>
                        <input type="date" class="form-control" name="date" id="exampleFormControlInput1" placeholder="jj/mm/aaaa" value="{{ $etudiants->date }}">
                        @error('date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="adresse">Adresse</label>
                        <input type="text" class="form-control" name="adresse" id="exampleFormControlInput1" placeholder="..." value="{{ $etudiants->adresse }}">
                        @error('adresse')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="..." value="{{ $etudiants->email }}">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tel">Telephone</label>
                        <input type="tel" class="form-control" name="tel" id="exampleFormControlInput1" placeholder="ex: +237658525704" value="{{ $etudiants->tel }}">
                        @error('tel')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="parent_id">
                            <option value="">Choisir un parent</option>
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}" {{ $etudiants->parent_id == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->nom }} {{ $parent->prenom }}
                                </option>
                            @endforeach
                        </select>
                        @error('parent_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="file">Image</label>
                        <input type="file" class="form-control" name="file" accept="image/*" value="{{ $etudiants->image }}">
                        @error('file')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="w-100 btn btn-primary"><i class="fa-solid fa-graduation-cap mx-1"></i>Modifier</button>
                </form>
            </div>
            <div class="col-3">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <h2 class="text-center fw-bold my-2"><u>Information sur le parent</u></h2>
                <div>
                    @foreach($parents as $parent)
                        @if($etudiants->parent_id == $parent->id)
                            <ol class="my-2">
                                <li>{{ $parent->nom }} {{ $parent->prenom }}</li>
                                <li>{{ $parent->adresse }}</li>
                                <li>{{ $parent->email }}</li>
                                <li>{{ $parent->tel }}</li>
                            </ol>
                            <div class="my-1">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Envoyer un mail au parent
                                </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('send.message', ['id' => $etudiants->id]) }}" method="post">
                                                    <label for="mes">Contenu du mail</label>
                                                    @csrf
                                                    <textarea class="form-control" name="mes" cols="3" rows="3"></textarea>
                                                    <button type="submit" class="btn btn-primary w-100 my-2">Envoyer l'email</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <hr>
                <div>
                    <h2 class="text-center fw-bold my-2"><u>Information sur les paiements</u></h2>
                    @php
                        $filtered_payments = $payements->where('student_id', $etudiants->id);
                    @endphp
                    @forelse($filtered_payments as $payement)
                        <ul class="my-2">
                            <li>
                                <strong>{{ $payement->montant }} </strong> en {{ $payement->methode }} le
                                <strong>
                                    @php
                                        $dt = Carbon::parse($payement->created_at)->locale('fr');
                                        echo $dt->translatedFormat('l j F Y à H:i:s ');
                                    @endphp
                                </strong>
                            </li>
                        </ul>
                    @empty
                        <p class="mx-2 my-1"><strong>Aucun paiement effectué !!!</strong></p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
@endsection
