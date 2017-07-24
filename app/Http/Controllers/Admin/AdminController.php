<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Ad;
use App\Models\Antenne;
use App\Models\Local;
use App\Models\Algeco;
use App\Models\Vehicule;
use App\Models\Evenement;
use App\Models\Structures;
use App\Models\Logement;
use App\Models\Contrat;
use App\Models\Sinistre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function adminIndex()
    {
    	$page = "home";
        
        $locaux = Local::all();
        $contrats = Contrat::all();
        $algecos = Algeco::all();
        $vehicules = Vehicule::all();
        $evenements = Evenement::all();
        $sinistres = Sinistre::all();

        //on retourne la vue avec les données qu'elle intègre
        return view('admin.home', compact('page', 'locaux', 'contrats', 'algecos', 'vehicules', 'evenements', 'sinistres'));
    }

    public function RechercheAD(Request $request, $id)
    {
    	$assos_dep = Ad::all();

        //on retourne la vue avec les données qu'elle intègre
        return view('admin.home', compact('assos_dep'));
    }
}
