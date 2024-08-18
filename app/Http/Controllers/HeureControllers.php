<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Heures;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HeureControllers extends Controller
{
    public function showFormAbsence(){
        $cours=Cours::all();
        $etudiants=Students::all();
        $heures=Heures::orderBy('id','desc')->get();
        return view('absence.createAbsence',compact('heures','etudiants','cours'));
    }

    public function searchAbsence(Request $request){
        $searchTem = $request->mot;
        $cours=Cours::all();
        $etudiants=Students::all();
        $heures = Heures::where('student_id', 'like', '%' . $searchTem . '%')->get();
        return view('absence.createAbsence', compact('heures','etudiants','cours'));
    }
    public function createAbsence(Request $request){

        $validator = Validator::make($request->all(), [
            'motif'=>'required',
            'date'=>'required',
            'justif'=>'required',
            'cours_id'=>'required',
            'student_id'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('absence.createAbsence')
                ->withErrors($validator)
                ->withInput();
        }else{
            Heures::create([
                'motif'=>$request->motif,
                'date'=>$request->date,
                'justif'=>$request->justif,
                'cours_id'=>$request->cours_id,
                'student_id'=>$request->student_id,
                'user_id'=>Auth::user()->id,
            ]);

            return back()->with('success','Absence  inseré avec success');
        }

    }
    public function deleteAbsence(string $id){
        $heures=Heures::findOrFail($id);

        $heures->delete();

        return redirect()->route('absence.createAbsence')->with('success','Absence  supprimé');
    }
    public function showFormUpdate(string $id){
        $heures=Heures::findOrFail($id);
        $cours=Cours::all();
        $etudiants=Students::all();
        return view('absence.updateAbsence',compact('heures','etudiants','cours'));
    }
    public function updateAbsence(string $id,Request $request){
        $validator = Validator::make($request->all(), [
            'motif'=>'required',
            'date'=>'required',
            'justif'=>'required',
            'cours_id'=>'required',
            'student_id'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect("/absence/update/$id")
                ->withErrors($validator)
                ->withInput();

        } else {
            $heures = Heures::findOrFail($id);
            $heures->update([
                'motif'=>$request->motif,
                'date'=>$request->date,
                'justif'=>$request->justif,
                'cours_id'=>$request->cours_id,
                'student_id'=>$request->student_id,
                'user_id'=>Auth::user()->id,
            ]);

            return redirect()->route('absence.createAbsence')->with('success','Absence  actualisé');
        }
    }
}
