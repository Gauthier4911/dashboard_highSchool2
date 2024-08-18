<?php

namespace App\Http\Controllers;

use App\Mail\MessageParentEmail;
use App\Models\Parents;
use App\Models\Payements;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Mail;

class EtudiantControllers extends Controller
{

    public function index()
    {
        $etudiants = Students::with('payements', 'parent')->get();
        $parents = Parents::all(); // ou avec une relation chargée

        return view('etudiant.createEtudiant', compact('etudiants', 'parents'));
    }
    public function showFormEtudiant(){
        $payements=Payements::all();
        $parents=Parents::all();
        $etudiants=Students::orderBy('id','desc')->get();
        return view('etudiant.createEtudiant',compact('etudiants','parents','payements'));
    }

    public function searchEtudiant(Request $request){
        $searchTerm = $request->input('mot');
        $parents=Parents::all();
        $etudiants = Students::where('nom', 'like', '%' . $searchTerm . '%')->get();

        return view('etudiant.createEtudiant', compact('etudiants','parents'));
    }
    public function createEtudiant(Request $request){

        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:50',
            'prenom' => 'required|max:50',
            'date'=>'required|date',
            'adresse'=>'required|min:5|max:50',
            'email'=>'required|email',
            'tel'=>'required',
            'parent_id'=>'required',
            'file' => [
                'required',
                File::image()
                    ->min('10kb')
                    ->max('2mb')
            ],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('etudiant.createEtudiant')
                ->withErrors($validator)
                ->withInput();
        }else{
            $file = $request->file('file');
            $name = time().$file->getClientOriginalName();

            $request->file('file')->storeAs(
                'imageEtu',
                $name,
                'public'
            );
            Students::create([
                'nom'=>$request->nom,
                'prenom'=>$request->prenom,
                'date'=>$request->date,
                'adresse'=>$request->adresse,
                'email'=>$request->email,
                'tel'=>$request->tel,
                'image'=>$name,
                'parent_id'=>$request->parent_id,
                'user_id'=>Auth::user()->id,
            ]);

            return back()->with('success','Etudiant  ajouter avec success');
        }

    }
    public function deleteEtudiant(string $id){
        $etudiants=Students::findOrFail($id);

        $imageLink=public_path('storage/imageEtu/'.$etudiants->image);
        \Illuminate\Support\Facades\File::delete($imageLink);

        $etudiants->delete();

        return redirect()->route('etudiant.createEtudiant')->with('success','Un etudiant  a été supprimé');
    }
    public function showFormUpdate(string $id){
        $payements = Payements::all();
        $etudiants=Students::findOrFail($id);
        $parents=Parents::all();
        $studentName = $etudiants->nom; // Récupérer le nom de l'étudiant
        return view('etudiant.updateEtudiant',compact('etudiants','parents','payements', 'studentName'));
    }
    public function updateEtudiant(string $id,Request $request){
        $file = $request->file('file');
        if ($file === null)
        {
            $validator = Validator::make($request->all(), [
                'nom' => 'required|max:50',
                'prenom' => 'required|max:50',
                'date' => 'required|date',
                'adresse' => 'required|min:5|max:50',
                'email' => 'required|email',
                'tel' => 'required',
                'parent_id'=>'required',
            ]);

            if ($validator->fails()) {
                return redirect("/etudiant/update/$id")
                    ->withErrors($validator)
                    ->withInput();

            } else {
                $etudiants = Students::findOrFail($id);
                $etudiants->update([
                    'nom'=>$request->nom,
                    'prenom'=>$request->prenom,
                    'date'=>$request->date,
                    'adresse'=>$request->adresse,
                    'email'=>$request->email,
                    'tel'=>$request->tel,
                    'parent_id'=>$request->parent_id,
                    'user_id'=>Auth::user()->id,
                ]);

                return redirect()->route('etudiant.createEtudiant')->with('success','Etudiant actualisé avec success');
            }
        }else{
            $validator = Validator::make($request->all(), [
                'nom' => 'required|max:50',
                'prenom' => 'required|max:50',
                'date' => 'required|date',
                'adresse' => 'required|min:5|max:50',
                'email' => 'required|email',
                'tel' => 'required',
                'parent_id'=>'required',
                'file' => [
                    'required',
                    File::image()
                        ->min('10kb')
                        ->max('2mb')
                ],
            ]);

            if ($validator->fails()) {
                return redirect("/etudiant/update/$id")
                    ->withErrors($validator)
                    ->withInput();

            }else{
                $file = $request->file('file');
                $etudiants=Students::findOrFail($id);
                $name = time().$file->getClientOriginalName();
                $request->file('file')->storeAs(
                    'imageEtu',
                    $name,
                    'public'
                );
                $etudiants->update([
                    'nom'=>$request->nom,
                    'prenom'=>$request->prenom,
                    'date'=>$request->date,
                    'adresse'=>$request->adresse,
                    'email'=>$request->email,
                    'tel'=>$request->tel,
                    'parent_id'=>$request->parent_id,
                    'image' => $name,
                    'user_id'=>Auth::user()->id,

                ]);

                return redirect()->route('etudiant.createEtudiant')->with('success','Etudiant actualisé avec success');
            }
        }
    }
    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'mes' => 'required',
        ]);

        $student = Students::findOrFail($id);
        $parent = $student->parent; // Récupérer le parent de l'étudiant

        // Passer le nom de l'étudiant à MessageParentEmail
        $mes = new MessageParentEmail($parent, $request->mes, $student->nom);

        Mail::to($parent->email)->send($mes);

        return redirect()->back()->with('success', 'Message envoyé avec succès');
    }
}
