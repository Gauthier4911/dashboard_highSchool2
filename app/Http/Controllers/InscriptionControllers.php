<?php

namespace App\Http\Controllers;


use App\Models\Inscriptions;
use App\Models\Salles;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InscriptionControllers extends Controller
{
    public function showFormInscription(){
        $salles=Salles::all();
        $etudiants=Students::all();
        $inscriptions=Inscriptions::orderBy('id','desc')->get();
        return view('inscription.createInscription',compact('inscriptions','etudiants','salles'));
    }


    public function searchEtudiant(Request $request){
        $searchTerm = $request->mot;
        $salles = Salles::all();
        $etudiants = Students::all();
        $inscriptions = Inscriptions::where('student_id', 'like', '%' . $searchTerm . '%')->get();
        return view('inscription.createInscription', compact('inscriptions','etudiants','salles'));
    }
    public function createInscription(Request $request){

        $validator = Validator::make($request->all(), [
            'salle_id'=>'required',
            'student_id'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('inscription.createInscription')
                ->withErrors($validator)
                ->withInput();
        }else{
            Inscriptions::create([
                'salle_id'=>$request->salle_id,
                'student_id'=>$request->student_id,
                'user_id'=>Auth::user()->id,
            ]);

            return back()->with('success','Inscription  Creer avec success');
        }

    }
    public function deleteInscription(string $id){
        $inscriptions=Inscriptions::findOrFail($id);

        $inscriptions->delete();

        return redirect()->route('inscription.createInscription')->with('success','Inscription  supprimé ');
    }
    public function showFormUpdate(string $id){
        $inscriptions=Inscriptions::findOrFail($id);
        $salles=Salles::all();
        $etudiants=Students::all();
        return view('inscription.updateInscription',compact('inscriptions','etudiants','salles'));
    }
    public function updateInscription(string $id,Request $request){
            $validator = Validator::make($request->all(), [
                'salle_id'=>'required',
                'student_id'=>'required',
            ]);

            if ($validator->fails()) {
                return redirect("/inscription/update/$id")
                    ->withErrors($validator)
                    ->withInput();

            } else {
                $etudiants = Inscriptions::findOrFail($id);
                $etudiants->update([
                    'salle_id'=>$request->salle_id,
                    'student_id'=>$request->student_id,
                    'user_id'=>Auth::user()->id,
                ]);

                return redirect()->route('inscription.createInscription')->with('success','Inscription  actualisé');
            }
    }
}
