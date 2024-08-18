@extends('welcome')


@section('body')

    <main class="container-fluid mt-3">
        <section class="row">
            <div class="col-2">
                @include('components.navbar2')
            </div>
            <div class="col-md-10">
                <h1 class=" fw-bold text-center"><strong>Bienvenu à l'école STARLINE</strong></h1>
                <p class="text-center">Pour cette année la scolarité s'éléve à <strong>400.000 FCFA</strong></p>
            </div>
        </section>
    </main>

@endsection
