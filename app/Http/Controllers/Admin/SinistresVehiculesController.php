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
                    ->orderBy('ref_rdc', 'asc')
                    ->orderBy('contrat_v_id', 'asc')
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
        $request->session()->forget('entities');

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
        $data = (new SinistresVehiculesController)->dataSinistreVehicule();

        $page = $data['page'];
        $pageSmall = $data['pageSmall'];

        $sinistre = Sinistre::findOrFail($id);
        $typesSinistre = $data['typeSinistres'];

        return view('admin.blocs.sinistres-edit-create', compact('page', 'pageSmall', 'sinistre', 'typesSinistre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SinistresRequest $request, $p, $ps, $id)
    {
        $page = $p;
        $pageSmall = $ps;

        $sinistre = Sinistre::findOrFail($id);

        //update du sinistre
        if ((strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE)) {
            
            $dateOuverture = date('Y-d-m', strtotime($request->date_ouverture));
            $dateReception = date('Y-d-m', strtotime($request->date_reception));
            $dateReception = date('Y-d-m', strtotime($request->date_sinistre));

            if ($request->has('date_cloture')) {
                $dateCloture = date('Y-d-m', strtotime($request->date_cloture));
            }else{
                $dateCloture = $request->date_cloture;
            }
            
        }else{
            $dateOuverture = $request->date_ouverture;
            $dateReception = $request->date_reception;
            $dateSinistre = $request->date_sinistre;
            $dateCloture = $request->date_cloture;
        }

        $updateSinistre = [
            'ref_macif' => $request->ref_macif,
            'ref_rdc' => $request->ref_rdc,
            'ville_sinistre' => $request->ville_sinistre,
            'date_ouverture' => $dateOuverture,
            'date_reception' => $dateReception,
            'date_sinistre' => $dateSinistre,
            'responsabilite' => $request->responsabilite,
            //'type_sinistre_id' => $request->type_sinistre_id,
            'observation' => $request->observation,
            'reglement_macif' => $request->reglement_macif, 
            'franchise' => $request->franchise, 
            'solde_ad' => $request->franchise, 
            'date_cloture' => $dateCloture  
        ];
        $sinistre->update( $updateSinistre ); 

        $sinistre->type_sinistre_id = $request->type_sinistre_id;
        $sinistre->save();

        return redirect()
                ->route('listeSinistresVehicules.index', [$page, $pageSmall])
                ->withSuccess('Le sinistre a bien été modifié.');
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
