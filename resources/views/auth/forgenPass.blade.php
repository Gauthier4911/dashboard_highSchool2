@extends('welcome')

@section('body')

    <main class="container mt-3">
        <section class="my-5 row" style="padding: 80px ">
            <p class="display-6 text-center">
                <strong>Reinitialiser votre mot de passe</strong>
            </p>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form  method="post" action="{{ route('forget.post') }}" >
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label "> Adresse Email</label>
                    <input type="email" id="email" name="email" placeholder="name@example.com" class="w-100 my-1  px-3"  style="outline: none;height: 40px " value="{{old('email')}}">
                    @error('email')
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-outline-primary w-100">Rechercher votre email</button>
                <p class="text-center my-3">
                    <a href="{{route('login')}}">Se connecter</a>
                </p>
            </form>
        </section>
    </main>

@endsection
