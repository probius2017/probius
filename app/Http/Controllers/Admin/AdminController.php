<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Ad;
use App\Models\Antenne;
use App\Models\Local;
use App\Models\Algeco;
use App\Models\Vehicule;
use App\Models\Evenement;
use App\Models\Logement;
use App\Models\Sinistre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function adminIndex()
    {
    	$page = "home";

        //On récupère tout les ACI avec RI >=50
        /*$aci50RI = Local::whereHas('structures', function($query){
        	$query->where('RI', '>=50');
        })->get();*/

        //on récupère tout les locaux avec leurs structures
        $locauxStructures = Local::LocauxStructures()->get();
        //$locauxStructures = Local::LocauxWithStructures();

        //dump($locauxStructures); die; 

        $algecos = Algeco::count();
        $vehicules = Vehicule::count();
        $evenements = Evenement::count();
        $sinistres = Sinistre::all();

        //on retourne la vue avec les données qu'elle intègre
        return view('admin.home', compact('page', 'locauxStructures', 'algecos', 'vehicules', 'evenements', 'sinistres'));
    }

    public function RechercheAD(Request $request, $id)
    {
    	$assos_dep = Ad::all();

        //on retourne la vue avec les données qu'elle intègre
        return view('admin.home', compact('assos_dep'));
    }
}
