<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\HomeContronllers::class,'home'])->name('home');

    Route::get('/logout', [\App\Http\Controllers\HomeContronllers::class,'logout'])->name('logout');

    Route::get('/classe/liste', [\App\Http\Controllers\ClassesControllers::class,'showFormClasse'])->name('pages.modalClasse');
    Route::post('/classe/liste', [\App\Http\Controllers\ClassesControllers::class,'createClasse'])->name('pages.modalClasse');

    Route::get('/classe/update/{id}', [\App\Http\Controllers\ClassesControllers::class,'showFormUpdate'])->whereNumber('id')->name('pages.updateClasse');
    Route::post('/classe/update/{id}', [\App\Http\Controllers\ClassesControllers::class,'updateClasse'])->whereNumber('id')->name('pages.updateClasse');

    Route::get('/classe/delete/{id}', [\App\Http\Controllers\ClassesControllers::class,'deleteClasse'])->whereNumber('id')->name('pages.delete');

    Route::get('/parent/liste', [\App\Http\Controllers\ParentsControllers::class,'showFormParent'])->name('parents.createParent');
    Route::post('/parent/liste', [\App\Http\Controllers\ParentsControllers::class,'createParent'])->name('parents.createParent');

    Route::get('/parent/update/{id}', [\App\Http\Controllers\ParentsControllers::class,'showFormUpdate'])->whereNumber('id')->name('parents.updateParent');
    Route::post('/parent/update/{id}', [\App\Http\Controllers\ParentsControllers::class,'updateParent'])->whereNumber('id')->name('parents.updateParent');

    Route::get('/parent/delete/{id}', [\App\Http\Controllers\ParentsControllers::class,'deleteParent'])->whereNumber('id')->name('parents.delete');

    Route::get('/etudiant/liste', [\App\Http\Controllers\EtudiantControllers::class,'showFormEtudiant'])->name('etudiant.createEtudiant');
    Route::post('/etudiant/liste', [\App\Http\Controllers\EtudiantControllers::class,'createEtudiant'])->name('etudiant.createEtudiant');

    Route::get('/etudiant/update/{id}', [\App\Http\Controllers\EtudiantControllers::class,'showFormUpdate'])->whereNumber('id')->name('etudiant.updateEtudiant');
    Route::post('/etudiant/update/{id}', [\App\Http\Controllers\EtudiantControllers::class,'updateEtudiant'])->whereNumber('id')->name('etudiant.updateEtudiant');


    Route::get('/etudiant/delete/{id}', [\App\Http\Controllers\EtudiantControllers::class,'deleteEtudiant'])->whereNumber('id')->name('etudiant.delete');

    Route::get('/etudiant/liste', [\App\Http\Controllers\EtudiantControllers::class,'searchEtudiant'])->name('etudiant.search');

    Route::post('/etudiant/send-message/{id}', [\App\Http\Controllers\EtudiantControllers::class,'sendMessage'])->whereNumber('id')->name('send.message');


    Route::get('/inscription/liste', [\App\Http\Controllers\InscriptionControllers::class,'showFormInscription'])->name('inscription.createInscription');
    Route::post('/inscription/liste', [\App\Http\Controllers\InscriptionControllers::class,'createInscription'])->name('inscription.createInscription');

    Route::get('/inscription/update/{id}', [\App\Http\Controllers\InscriptionControllers::class,'showFormUpdate'])->whereNumber('id')->name('inscription.updateInscription');
    Route::post('/inscription/update/{id}', [\App\Http\Controllers\InscriptionControllers::class,'updateInscription'])->whereNumber('id')->name('inscription.updateInscription');

    Route::get('/inscription/delete/{id}', [\App\Http\Controllers\InscriptionControllers::class,'deleteInscription'])->whereNumber('id')->name('inscription.delete');

    Route::get('/inscription/liste', [\App\Http\Controllers\InscriptionControllers::class,'searchEtudiant'])->name('inscription.search');


    Route::get('/payement/liste', [\App\Http\Controllers\PayementControllers::class,'showFormPayement'])->name('payement.createPayement');
    Route::post('/payement/liste', [\App\Http\Controllers\PayementControllers::class,'createPayement'])->name('payement.createPayement');


    Route::get('/payement/delete/{id}', [\App\Http\Controllers\PayementControllers::class,'deletePayement'])->whereNumber('id')->name('payement.delete');

    Route::get('/enseignant/liste', [\App\Http\Controllers\EnseignantControllers::class,'showFormEnseignant'])->name('enseignant.createEnseignant');
    Route::post('/enseignant/liste', [\App\Http\Controllers\EnseignantControllers::class,'createEnseignant'])->name('enseignant.createEnseignant');

    Route::get('/enseignant/update/{id}', [\App\Http\Controllers\EnseignantControllers::class,'showFormUpdate'])->whereNumber('id')->name('enseignant.updateEnseignant');
    Route::post('/enseignant/update/{id}', [\App\Http\Controllers\EnseignantControllers::class,'updateEnseignant'])->whereNumber('id')->name('enseignant.updateEnseignant');

    Route::get('/enseignant/delete/{id}', [\App\Http\Controllers\EnseignantControllers::class,'deleteEnseignant'])->whereNumber('id')->name('enseignant.delete');

    Route::get('/enseignant/liste', [\App\Http\Controllers\EnseignantControllers::class,'searchEnseignant'])->name('enseignant.search');

    Route::get('/cour/liste', [\App\Http\Controllers\CourControllers::class,'showFormCour'])->name('cour.createCour');
    Route::post('/cour/liste', [\App\Http\Controllers\CourControllers::class,'createCour'])->name('cour.createCour');

    Route::get('/cour/update/{id}', [\App\Http\Controllers\CourControllers::class,'showFormUpdate'])->whereNumber('id')->name('cour.updateCour');
    Route::post('/cour/update/{id}', [\App\Http\Controllers\CourControllers::class,'updateCour'])->whereNumber('id')->name('cour.updateCour');

    Route::get('/cour/delete/{id}', [\App\Http\Controllers\CourControllers::class,'deleteCour'])->whereNumber('id')->name('cour.delete');

    Route::get('/note/liste', [\App\Http\Controllers\NoteControllers::class,'showFormNote'])->name('note.createNote');
    Route::post('/note/liste', [\App\Http\Controllers\NoteControllers::class,'createNote'])->name('note.createNote');

    Route::get('/note/update/{id}', [\App\Http\Controllers\NoteControllers::class,'showFormUpdate'])->whereNumber('id')->name('note.updateNote');
    Route::post('/note/update/{id}', [\App\Http\Controllers\NoteControllers::class,'updateNote'])->whereNumber('id')->name('note.updateNote');

    Route::get('/note/delete/{id}', [\App\Http\Controllers\NoteControllers::class,'deleteNote'])->whereNumber('id')->name('note.delete');

    Route::get('/note/liste', [\App\Http\Controllers\NoteControllers::class,'searchNote'])->name('note.search');

    Route::get('/absence/liste', [\App\Http\Controllers\HeureControllers::class,'showFormAbsence'])->name('absence.createAbsence');
    Route::post('/absence/liste', [\App\Http\Controllers\HeureControllers::class,'createAbsence'])->name('absence.createAbsence');

    Route::get('/absence/update/{id}', [\App\Http\Controllers\HeureControllers::class,'showFormUpdate'])->whereNumber('id')->name('absence.updateAbsence');
    Route::post('/absence/update/{id}', [\App\Http\Controllers\HeureControllers::class,'updateAbsence'])->whereNumber('id')->name('absence.updateAbsence');

    Route::get('/absence/delete/{id}', [\App\Http\Controllers\HeureControllers::class,'deleteAbsence'])->whereNumber('id')->name('absence.delete');

    Route::get('/absence/liste', [\App\Http\Controllers\HeureControllers::class,'searchAbsence'])->name('absence.search');



});

Route::get('/login', [\App\Http\Controllers\AuthContronllers::class,'showFormLogin'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthContronllers::class,'login'])->name('login');

Route::get('/register', [\App\Http\Controllers\AuthContronllers::class,'showFormResgiter'])->name('register');
Route::post('/register', [\App\Http\Controllers\AuthContronllers::class,'register'])->name('register');

Route::get('/forget', [\App\Http\Controllers\AuthContronllers::class, 'showFormForget'])->name('forget.form');
Route::post('/forget', [\App\Http\Controllers\AuthContronllers::class, 'forget'])->name('forget.post');

Route::post('/forget/update/{id}', [\App\Http\Controllers\AuthContronllers::class,'updateUser'])->whereNumber('id')->name('passChange');
Route::get('/forget/update/{id}', [\App\Http\Controllers\AuthContronllers::class,'formUpdatePass'])->whereNumber('id')->name('passChange');

Route::fallback(function () {
    return redirect('/');
});
