<?php

namespace App\Http\Controllers\Admin;

use Route;
use URL;
use DB;
use Response;
use App\Models\Contrat;
use App\Models\ContratV;
use App\Models\Sinistre;
use App\Models\TypeSinistre;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\SinistresRequest;
use App\Http\Controllers\Controller;

class SinistresVehiculesController extends Controller
{   
    public function dataSinistreVehicule(){

        $entities = Sinistre::whereNull('contrat_id')
                    ->whereNotNull('contrat_v_id')
                    ->get();

        $typeSinistres =  TypeSinistre::all();

        $page = 'Sinistres';
        $pageSmall = 'Véhicules';

        $array = ['entities' => $entities, 'typeSinistres' => $typeSinistres, 'page' => $page, 'pageSmall' => $pageSmall];

        return $array;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = (new SinistresVehiculesController)->dataSinistreVehicule();

        $request->session()->forget('columns');
        $request->session()->forget('champsFinal');

        $routeName = Route::currentRouteName();

        $page = $data['page'];
        $pageSmall = $data['pageSmall'];

        $colonnes = ['ad_id', 'ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'date_cloture', 'ville_sinistre', 'ref', 'name_marque', 'immat','id'];

        $entities = $data['entities'];

        DB::table('champsUpdate')
            ->whereIn('old_name', $colonnes)
            ->update(['status' => 1]);

        DB::table('champsUpdate')
            ->whereNotIn('old_name', $colonnes)
            ->update(['status' => 0]);

        $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'ville_sinistre', 'ref', 'name_marque', 'immat', 'reference', 'responsabilite', 'observation', 'reglement_macif', 'franchise', 'solde_ad', 'date_cloture'])
                ->get();

        $champsFinal = DB::table('champsUpdate')
                    ->select('new_name', 'old_name', 'table_name')
                    ->whereIn('old_name', $colonnes)
                    ->get();

        $request->session()->put('champsFinal', $champsFinal);

        return view('admin.blocs.entities', compact('page', 'pageSmall', 'entities', 'champs', 'champsFinal', 'colonnes', 'routeName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($p, $ps, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $p, $ps, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($p, $ps, $id)
    {
         //Pas de supression pour les sinistres 
    }
    
}
