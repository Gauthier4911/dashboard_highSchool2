<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Salles;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CourControllers extends Controller
{
    public function showFormCour(){
        $teachers=Teachers::all();
        $salles=Salles::all();
        $cours=Cours::orderBy('id','desc')->get();
        return view('cour.createCour',compact('cours','teachers','salles'));
    }
    public function createCour(Request $request){

        $validator = Validator::make($request->all(), [
            'matiere' => 'required|max:50',
            'heure' => 'required',
            'date'=>'required',
            'teacher_id'=>'required',
            'salle_id'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('cour.createCour')
                ->withErrors($validator)
                ->withInput();
        }else{
            Cours::create([
                'matiere'=>$request->matiere,
                'heure'=>$request->heure,
                'date'=>$request->date,
                'teacher_id'=>$request->teacher_id,
                'salle_id'=>$request->salle_id,
                'user_id'=>Auth::user()->id,
            ]);

            return back()->with('success','Cour  ajouter avec success');
        }

    }
    public function deleteCour(string $id){
        $cours=Cours::findOrFail($id);
        $cours->delete();

        return redirect()->route('cour.createCour')->with('success','Cour  suprimé');
    }
    public function showFormUpdate(string $id){
        $teachers=Teachers::all();
        $salles=Salles::all();
        $cours=Cours::findOrFail($id);
        return view('cour.updateCour',compact('cours','teachers','salles'));
    }
    public function updateCour(string $id,Request $request){
        $validator = Validator::make($request->all(), [
            'matiere' => 'required|max:50',
            'heure' => 'required',
            'date'=>'required',
            'teacher_id'=>'required',
            'salle_id'=>'required'
        ]);

        if ($validator->fails()) {
            return redirect("/cour/update/$id")
                ->withErrors($validator)
                ->withInput();

        } else {
            $cours=Cours::findOrFail($id);
            $cours->update([
                'matiere'=>$request->matiere,
                'heure'=>$request->heure,
                'date'=>$request->date,
                'teacher_id'=>$request->teacher_id,
                'salle_id'=>$request->salle_id,
                'user_id'=>Auth::user()->id,
            ]);

            return redirect()->route('cour.createCour')->with('success','Cour  actuaisé');
        }
    }
}
