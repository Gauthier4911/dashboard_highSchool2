<div class="d-flex align-items-start">
    <div class="nav flex-column nav-pills me-5 border w-auto h-auto border-secondary-subtle border-1 rounded" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link text-black text-start {{ Request::is('classe/*') ? 'active' : '' }}" href="{{ route('pages.modalClasse') }}">Gestion des classes</a>
        <a class="nav-link text-black text-start {{ Request::is('parent/*') ? 'active' : '' }}" href="{{ route('parents.createParent') }}">Gestion des parents</a>
        <a class="nav-link text-black text-start {{ Request::is('etudiant/*') ? 'active' : '' }}" href="{{ route('etudiant.createEtudiant') }}">Gestion des étudiants</a>
        <a class="nav-link text-black text-start {{ Request::is('inscription/*') ? 'active' : '' }}" href="{{ route('inscription.createInscription') }}">Gestion des inscriptions</a>
        <a class="nav-link text-black text-start {{ Request::is('payement/*') ? 'active' : '' }}" href="{{ route('payement.createPayement') }}">Gestion des payements</a>
        <a class="nav-link text-black text-start {{ Request::is('enseignant/*') ? 'active' : '' }}" href="{{ route('enseignant.createEnseignant') }}">Gestion des enseignants</a>
        <a class="nav-link text-black text-start {{ Request::is('cour/*') ? 'active' : '' }}" href="{{ route('cour.createCour') }}">Gestion des cours</a>
        <a class="nav-link text-black text-start {{ Request::is('note/*') ? 'active' : '' }}" href="{{ route('note.createNote') }}">Gestion des notes</a>
        <a class="nav-link text-black text-start {{ Request::is('absence/*') ? 'active' : '' }}" href="{{ route('absence.createAbsence') }}">Gestion des absences</a>
    </div>
</div>
