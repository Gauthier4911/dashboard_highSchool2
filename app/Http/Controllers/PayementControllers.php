<?php

namespace App\Http\Controllers;

use App\Models\Inscriptions;
use App\Models\Payements;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PayementControllers extends Controller
{
    public function showFormPayement(){
        $etudiants=Students::all();
        $inscriptions=Inscriptions::all();
        $payements=Payements::orderBy('id','desc')->get();
        return view('payement.createPayement',compact('payements','etudiants','inscriptions'));
    }
    public function createPayement(Request $request){

        $validator = Validator::make($request->all(), [
            'montant'=>'required|numeric|max:400000',
            'methode'=>'required',
            'student_id'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('payement.createPayement')
                ->withErrors($validator)
                ->withInput();
        }else{
            Payements::create([
                'montant'=>$request->montant,
                'methode'=>$request->methode,
                'student_id'=>$request->student_id,
                'user_id'=>Auth::user()->id,
            ]);

            return back()->with('success','Payement  effectué avec success');
        }

    }
    public function deletePayement(string $id){
        $payements=Payements::findOrFail($id);

        $payements->delete();

        return redirect()->route('payement.createPayement')->with('success','Payement  supprimé');
    }
}
