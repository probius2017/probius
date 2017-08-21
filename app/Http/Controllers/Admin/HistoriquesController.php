<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Admin;

use DB;
use Route;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\HistoriqueLocal;
use App\Models\HistoriqueVehicule;
use App\Http\Controllers\Controller;

class HistoriquesController extends Controller
{
    public function historiqueLocaux()
    {
        $page = 'Historique';
        $pageSmall = 'Locaux';
        $routeName = Route::currentRouteName();

        $historiques = HistoriqueLocal::all();
        //$historiques = DB::table('historiqueLocaux')->get();
        
        return view('admin.blocs.historiques', compact('page', 'pageSmall', 'routeName', 'historiques')); 
    }

    public function historiqueVehicules()
    {
        $page = 'Historique';
        $pageSmall = 'Véhicules';
        $routeName = Route::currentRouteName();

        $historiques = HistoriqueVehicule::all();
        //$historiques = DB::table('historiqueVehicules')->get();

        return view('admin.blocs.historiques', compact('page', 'pageSmall', 'routeName', 'historiques')); 
    }
}
