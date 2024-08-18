<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthContronllers extends Controller
{
    public function showFormResgiter(){
        return view('auth.register');
    }
    public function showFormLogin(){
        return view('auth.login');
    }

    public function showFormForget(){
        return view('auth/forgenPass');
    }

    public function forget(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Le champ adresse email selectionné est invalide.',
            ])->withInput();
        }

        // Envoyer un e-mail à l'utilisateur avec le lien de réinitialisation
        $link = route('passChange', ['id' => $user->id]); // Suppose que vous avez une route 'forget.update' pour la réinitialisation
        Mail::to($user->email)->send(new ResetPasswordEmail($link));

        return back()->with('success', 'Un lien de réinitialisation de mot de passe a été envoyé à votre adresse e-mail.');
    }


    public function formUpdatePass(string $id){
        $user=User::findOrFail($id);
        return view('auth/passChange',compact('user'));
    }

    public function updateUser(string $id,Request $request){
        $file = $request->file('file');
        if ($file === null) {
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:8',
            ]);

            if ($validator->fails()) {
                return redirect("/forget/update/$id")
                    ->withErrors($validator)
                    ->withInput();

            } else {
                $user=User::findOrFail($id);
                $user->update([
                    'password' => Hash::make($request->password),
                ]);

                return redirect()->route('login');
            }
        }else{
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:8',
            ]);

            if ($validator->fails()) {
                return redirect("/forget/update/$id")
                    ->withErrors($validator)
                    ->withInput();

            }else{
                $user=User::findOrFail($id);
                $user->update([
                    'password' => 'required|confirmed|min:8',
                ]);

                return redirect()->route('login');
            }
        }
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('register')
                ->withErrors($validator)
                ->withInput();
        }else{
            User::create([
                'name'=>$request->nom,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);
            return redirect()->route('login');
        }
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Identifiant incorrect.',
        ])->onlyInput('email');
    }
}
