<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Notes;
use App\Models\Students;
use App\Models\Teachers;
use App\Models\Inscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NoteControllers extends Controller
{
    public function showFormNote(){
        $teachers=Teachers::all();
        $cours=Cours::all();
        $etudiants=Students::all();
        $inscriptions=Inscriptions::all();
        $notes=Notes::orderBy('id','desc')->get();
        return view('note.createNote',compact('notes','etudiants','teachers','cours','inscriptions'));
    }

    public function searchNote(Request $request){
        $searchTerm = $request->mot;
        $teachers=Teachers::all();
        $cours=Cours::all();
        $etudiants=Students::all();
        $inscriptions=Inscriptions::all();
        $notes = Notes::where('student_id', 'like', '%' . $searchTerm . '%')->get();
        return view('note.createNote', compact('notes','etudiants','cours','teachers','inscriptions'));
    }
    public function createNote(Request $request){

        $validator = Validator::make($request->all(), [
            'moy'=>'required',
            'teacher_id'=>'required',
            'cours_id'=>'required',
            'student_id'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('note.createNote')
                ->withErrors($validator)
                ->withInput();
        }else{
            Notes::create([
                'moy'=>$request->moy,
                'teacher_id'=>$request->teacher_id,
                'cours_id'=>$request->cours_id,
                'student_id'=>$request->student_id,
                'user_id'=>Auth::user()->id,
            ]);

            return back()->with('success','Note  Inserer avec success');
        }

    }
    public function deleteNote(string $id){
        $notes=Notes::findOrFail($id);

        $notes->delete();

        return redirect()->route('note.createNote')->with('success','Note  supprimé');
    }
    public function showFormUpdate(string $id){
        $teachers=Teachers::all();
        $cours=Cours::all();
        $etudiants=Students::all();
        $inscriptions=Inscriptions::all();
        $notes=Notes::findOrFail($id);
        return view('note.updateNote',compact('notes','etudiants','teachers','cours','inscriptions'));
    }
    public function updateNote(string $id,Request $request){
        $validator = Validator::make($request->all(), [
            'moy'=>'required',
            'teacher_id'=>'required',
            'cours_id'=>'required',
            'student_id'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect("/note/update/$id")
                ->withErrors($validator)
                ->withInput();

        } else {
            $notes = Notes::findOrFail($id);
            $notes->update([
                'moy'=>$request->moy,
                'teacher_id'=>$request->teacher_id,
                'cours_id'=>$request->cours_id,
                'student_id'=>$request->student_id,
                'user_id'=>Auth::user()->id,
            ]);

            return redirect()->route('note.createNote')->with('success','Note  actualisé');
        }
    }
}
