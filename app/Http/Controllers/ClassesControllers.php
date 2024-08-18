<?php

namespace App\Http\Controllers;

use App\Models\Salles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ClassesControllers extends Controller
{
    public function showFormClasse(){
        $salles=Salles::orderBy('id','desc')->get();
        return view('pages.modalClasse',compact('salles'));
    }
    public function createClasse(Request $request){
        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:50',
            'cycle' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('pages.modalClasse')
                ->withErrors($validator)
                ->withInput();
        }else{
            Salles::create([
                'nom'=>$request->nom,
                'cycle'=>$request->cycle,
                'user_id'=>Auth::user()->id,
            ]);

            return back()->with('success','Une classe  inserer avec success');
        }

    }
    public function deleteClasse(string $id){
        $salles=Salles::findOrFail($id);
        $salles->delete();

        return redirect()->route('pages.modalClasse')->with('success','Une classe a été supprimé');
    }
    public function showFormUpdate(string $id){
        $salles=Salles::findOrFail($id);
        return view('pages.updateClasse',compact('salles'));
    }
    public function updateClasse(string $id,Request $request){
            $validator = Validator::make($request->all(), [
                'nom' => 'required|max:50',
                'cycle' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect("/classe/update/$id")
                    ->withErrors($validator)
                    ->withInput();

            } else {
                $salles=Salles::findOrFail($id);
                $salles->update([
                    'nom'=>$request->nom,
                    'cycle'=>$request->cycle,
                    'user_id'=>Auth::user()->id,
                ]);

                return redirect()->route('pages.modalClasse')->with('success','Classe actualisé avec success');
            }
        }
}
