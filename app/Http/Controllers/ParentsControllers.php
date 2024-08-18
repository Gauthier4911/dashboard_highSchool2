<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ParentsControllers extends Controller
{
    public function showFormParent(){
        $parents=Parents::orderBy('id','desc')->get();
        return view('parents.createParent',compact('parents'));
    }
    public function createParent(Request $request){

        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:50',
            'prenom' => 'required|max:50',
            'adresse'=>'required|min:5|max:50',
            'email'=>'required|email',
            'tel'=>'required|min:9|max:13',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('parents.createParent')
                ->withErrors($validator)
                ->withInput();
        }else{
            Parents::create([
                'nom'=>$request->nom,
                'prenom'=>$request->prenom,
                'adresse'=>$request->adresse,
                'email'=>$request->email,
                'tel'=>$request->tel,
                'user_id'=>Auth::user()->id,
            ]);

            return back()->with('success','Parent  ajouter avec success');
        }

    }
    public function deleteParent(string $id){
        $parents=Parents::findOrFail($id);
        $parents->delete();

        return redirect()->route('parents.createParent')->with('success','Un parent a été supprimé');
    }
    public function showFormUpdate(string $id){
        $parents=Parents::findOrFail($id);
        return view('parents.updateParent',compact('parents'));
    }
    public function updateParent(string $id,Request $request){
        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:50',
            'prenom' => 'required|max:50',
            'adresse'=>'required|min:5|max:50',
            'email'=>'required|email',
            'tel'=>'required|min:9|max:13',
        ]);

        if ($validator->fails()) {
            return redirect("/parent/update/$id")
                ->withErrors($validator)
                ->withInput();

        } else {
            $parents=Parents::findOrFail($id);
            $parents->update([
                'nom'=>$request->nom,
                'prenom'=>$request->prenom,
                'adresse'=>$request->adresse,
                'email'=>$request->email,
                'tel'=>$request->tel,
                'user_id'=>Auth::user()->id,
            ]);

            return redirect()->route('parents.createParent')->with('success','Parent actualisé avec success');
        }
    }
}
