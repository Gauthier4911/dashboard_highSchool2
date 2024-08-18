<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Salles;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class EnseignantControllers extends Controller
{
    public function showFormEnseignant(){
        $teachers=Teachers::orderBy('id','desc')->get();
        return view('enseignant.createEnseignant',compact('teachers'));
    }

    public function searchEnseignant(Request $request){
        $searchTe = $request->input('tot');
        $teachers = Teachers::where('nom', 'like', '%' . $searchTe . '%')->get();

        return view('enseignant.createEnseignant', compact('teachers'));
    }
    public function createEnseignant(Request $request){

        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:50',
            'prenom' => 'required|max:50',
            'date'=>'required|date',
            'adresse'=>'required|min:5|max:50',
            'email'=>'required|email',
            'tel'=>'required',
            'matiere'=>'required',
            'date2'=>'required|date',
            'file' => [
                'required',
                File::image()
                    ->min('10kb')
                    ->max('2mb')
            ],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('enseignant.createEnseignant')
                ->withErrors($validator)
                ->withInput();
        }else{
            $file = $request->file('file');
            $name = time().$file->getClientOriginalName();

            $request->file('file')->storeAs(
                'imageTea',
                $name,
                'public'
            );
            Teachers::create([
                'nom'=>$request->nom,
                'prenom'=>$request->prenom,
                'date'=>$request->date,
                'adresse'=>$request->adresse,
                'email'=>$request->email,
                'tel'=>$request->tel,
                'matiere'=>$request->matiere,
                'date2'=>$request->date2,
                'image'=>$name,
                'user_id'=>Auth::user()->id,
            ]);

            return back()->with('success','Enseignant  ajouter avec success');
        }

    }
    public function deleteEnseignant(string $id){
        $teachers=Teachers::findOrFail($id);

        $imageLink=public_path('storage/imageTea/'.$teachers->image);
        \Illuminate\Support\Facades\File::delete($imageLink);

        $teachers->delete();

        return redirect()->route('enseignant.createEnseignant')->with('success','Enseignant  Supprimé');
    }
    public function showFormUpdate(string $id){
        $cours=Cours::all();
        $salles=Salles::all();
        $teachers=Teachers::findOrFail($id);
        return view('enseignant.updateEnseignant',compact('teachers','cours','salles'));
    }
    public function updateEnseignant(string $id,Request $request){
        $file = $request->file('file');
        if ($file === null)
        {
            $validator = Validator::make($request->all(), [
                'nom' => 'required|max:50',
                'prenom' => 'required|max:50',
                'date'=>'required|date',
                'adresse'=>'required|min:5|max:50',
                'email'=>'required|email',
                'tel'=>'required',
                'matiere'=>'required',
                'date2'=>'required|date',
            ]);

            if ($validator->fails()) {
                return redirect("/enseignant/update/$id")
                    ->withErrors($validator)
                    ->withInput();

            } else {
                $teachers = Teachers::findOrFail($id);
                $teachers->update([
                    'nom'=>$request->nom,
                    'prenom'=>$request->prenom,
                    'date'=>$request->date,
                    'adresse'=>$request->adresse,
                    'email'=>$request->email,
                    'tel'=>$request->tel,
                    'matiere'=>$request->matiere,
                    'date2'=>$request->date2,
                    'user_id'=>Auth::user()->id,
                ]);

                return redirect()->route('enseignant.createEnseignant')->with('success','Enseignant  actualisé');
            }
        }else{
            $validator = Validator::make($request->all(), [
                'nom' => 'required|max:50',
                'prenom' => 'required|max:50',
                'date'=>'required|date',
                'adresse'=>'required|min:5|max:50',
                'email'=>'required|email',
                'tel'=>'required',
                'matiere'=>'required',
                'date2'=>'required|date',
                'file' => [
                    'required',
                    File::image()
                        ->min('10kb')
                        ->max('2mb')
                ],
            ]);

            if ($validator->fails()) {
                return redirect("/enseignant/update/$id")
                    ->withErrors($validator)
                    ->withInput();

            }else{
                $file = $request->file('file');
                $teachers=Teachers::findOrFail($id);
                $name = time().$file->getClientOriginalName();
                $request->file('file')->storeAs(
                    'imageTea',
                    $name,
                    'public'
                );
                $teachers->update([
                    'nom'=>$request->nom,
                    'prenom'=>$request->prenom,
                    'date'=>$request->date,
                    'adresse'=>$request->adresse,
                    'email'=>$request->email,
                    'tel'=>$request->tel,
                    'matiere'=>$request->matiere,
                    'date2'=>$request->date2,
                    'image'=>$name,
                    'user_id'=>Auth::user()->id,

                ]);

                return redirect()->route('enseignant.createEnseignant')->with('success','Enseignant  actualisé');
            }
        }
    }
}
