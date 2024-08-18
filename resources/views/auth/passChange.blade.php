@extends('welcome')

@section('body')

    <main class="container mt-5">
        <section class="my-5 row" style="padding: 80px ">
            <p class="col-lg-7">
            <h3 class="text-center">Changer le mot de passe</h3>
            <form action="{{route('passChange',['id'=>$user->id])}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de Passe</label>
                    <input type="password" id="pass" name="password" class="w-100 my-1 border border-primary px-3"  style="outline: none;height: 40px "  value="{{old('password')}}" >
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pass2" class="form-label">Confirmation Mot de Passe</label>
                    <input type="password" id="pass2" name="password_confirmation" class="w-100 my-1 border border-primary px-3"  style="outline: none;height: 40px " value="{{old('password')}}">
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-outline-primary w-100">Confirmer</button>
            </form>
            </div>
        </section>
    </main>
@endsection

