<?php

namespace App\Http\Controllers\Admin;

use Route;
use URL;
use DB;
//use Carbon\Carbon;
use Jenssegers\Date\Date;
use Response;
use App\Models\Ad;
use App\Models\ContratV;
use App\Models\Vehicule;
use App\Models\Sinistre;
use App\Models\Marque;
use App\Models\Modele;
Use App\Models\Category;
use App\Models\Garantie;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\VehiculesRequest;
use App\Http\Controllers\Controller;

class VehiculesController extends Controller
{
    public function dataVehicule(){

        $entities = Vehicule::where('date_delete', null)->get();

        $page = 'Vehicules';
        $pageSmall = ' ';

        $array = ['entities' => $entities, 'page' => $page, 'pageSmall' => $pageSmall];

        return $array;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = (new VehiculesController)->dataVehicule();

        $request->session()->forget('columns');
        $request->session()->forget('champsFinal');
        $request->session()->forget('entities');

        $routeName = Route::currentRouteName();

        $page = $data['page'];
        $pageSmall = $data['pageSmall'];

        $colonnes = ['ad_id', 'type', 'reference', 'name_marque', 'name_modele', 'immat', 'id'];

        $entities = $data['entities'];

        DB::table('champsUpdate')
            ->whereIn('old_name', $colonnes)
            ->update(['status' => 1]);

        DB::table('champsUpdate')
            ->whereNotIn('old_name', $colonnes)
            ->update(['status' => 0]);

        $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['type', 'name_marque', 'name_modele', 'immat', 'old_immat', 'pmc', 'atp', 'numero_contratV', 'reference'])
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
        $data = (new VehiculesController)->dataVehicule();

        $page = $data['page'];
        $pageSmall = $data['pageSmall'];

        $vehicule = Vehicule::findOrFail($id);

        $marques = Marque::orderBy('name_marque')->get();
        $modeles = Modele::orderBy('name_modele')->get();
        $categories = Category::orderBy('type')->get();
        $garanties = Garantie::all();

        return view('admin.blocs.vehicules-edit-create', compact('page', 'pageSmall', 'vehicule', 'marques', 'modeles', 'categories', 'garanties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VehiculesRequest $request, $p, $ps, $id)
    {
        $page = $p;
        $pageSmall = $ps;

        $vehicule = Vehicule::findOrFail($id);
        //Vérification si pas de doublon pour les immattriculations 
        /*$immat = Vehicule::select('immat')->where('immat', $request->immat)->get();
        foreach ($immat as $im) {
            
            $doublons[] = $im->immat; 
        }

        $old_immat = Vehicule::select('old_immat')->where('old_immat', $request->old_immat)->get();
        foreach ($old_immat as $ol) {
            
            $doublons[] = $ol->old_immat; 
        }

        if (!empty($doublons) && ($vehicule->immat != $request->immat || $vehicule->old_immat != $request->old_immat)){

             return back()
                    ->withErrors('Ce numéro d\'immatriculation existe déjà.');
        }*/

        $immat = Vehicule::where('immat', $request->immat)->get();

        if ($request->old_immat != null) {
            $old_immat = Vehicule::where('old_immat', $request->old_immat)->count();
        }else{
            $old_immat  = 0;
        }

        if ($immat->count() != 0 && $vehicule->immat != $request->immat){

             return back()
                    ->withErrors('Ce numéro d\'immatriculation existe déjà.');
        }
        if ($old_immat != 0 && $vehicule->old_immat != $request->old_immat){

             return back()
                    ->withErrors('Ce numéro d\'immatriculation existe déjà.');
        }
       
        //update du véhicule
        if ((strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE)) {
            
            $pmc = date('Y-d-m', strtotime($request->pmc));
            $atp = date('Y-d-m', strtotime($request->atp));

        }else{
            $pmc = $request->pmc;
            $atp = $request->atp;
        }

        $updateVehicule = [
            'immat' => $request->immat,
            'old_immat' => $request->old_immat,
            'pmc' => $pmc,
            'atp' => $atp
        ];
        $vehicule->update( $updateVehicule );

        //Update marque / modele du véhicule
        $vehicule->marque_id = $request->marque_id;
        $vehicule->modele_id = $request->modele_id;
        $vehicule->save();

        //Update catégorie liée au model
        $category = $vehicule->modele;
        $category->category_id = $request->category_id;
        $category->save();

        //Update garantie liée au contrat
        $garantie = $vehicule->ContratV;
        $garantie->garantie_id = $request->garantie_id;
        $garantie->save();

        return redirect()
                ->route('listeVehicules.index', [$page, $pageSmall])
                ->withSuccess('Le véhicule a bien été modifié.');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $p, $ps, $id)
    {
        $page = $p;
        $pageSmall = $ps;
        $dateSupr = Date::now();

        if ($request->date_resiliation == null) {
            
            return back()->withInput($request->only('motif'))->withErrors('Veuillez indiquer une date de résiliation');
        }

        $vehicule = Vehicule::find($id);
        $modele = $vehicule->modele;

        //Insertion des données dans la table historiqueVehicules
        $historiqueVehicule = DB::table('historiqueVehicules')->insert([
                    [   
                        'ad' => $vehicule->ad->numero_ad,
                        'immat' => $vehicule->immat, 
                        'marque' => $vehicule->marque->name_marque, 
                        'model' =>  $modele->name_modele, 
                        'date_resiliation'=> $request->date_resiliation, 
                        'motif'=> $request->motif,
                        'created_at' => $dateSupr
                    ] 

            ]); 

        //On ajoute la date de supression pour signaler que le véhicule est suprimer
        $vehicule->date_delete = $dateSupr;
        $vehicule->save();

        //On clotures les sinistres liés à ce véhicule
        /*$sinistres = $vehicule->ContratV->sinistres;
        $entities = $sinistres->toArray();

        if (!empty($entities)) {
            
            foreach ($sinistres as $sinistre) {
                
                if ($sinistre->date_cloture == null) {
                    $sinistre->date_cloture = $dateSupr;
                    $sinistre->save();
                }
            }
        }*/

        return redirect()
                ->route('listeVehicules.index', [$page, $pageSmall])
                ->withSuccess('Le véhicule a bien été supprimé.');
    }
}
