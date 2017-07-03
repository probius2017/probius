<?php

namespace App\Http\Controllers\Admin;

use DB;
use Carbon\Carbon;
use App\Http\Requests;
use App\Models\Local;
use App\Models\Bail;
use App\Models\Structure;
use App\Models\Contrat;
use Illuminate\Http\Request;
use App\Http\Requests\LocauxRequest;
use App\Http\Controllers\Controller;

class LocauxInf25Controller extends Controller
{   
    //fonction pour regrouper les données à utiliser dans le controller
    public function dataLocauxInf25(){
 
        $local = Local::LocauxStructures()->where('RI', '<=25')->get();
        $structures = Structure::where('RI', '<=25')->get();

        $array = ['local' => $local, 'structures' => $structures];

        return $array;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $page = 'locauxInf25';
        
        $data = (new LocauxInf25Controller)->dataLocauxInf25();

        $locauxStructures = $data['local'];
        $structures = $data['structures'];
        
        $champs = DB::table('champsUpdate')->select('champsUpdate.*')->where('table_name', 'locaux')->orWhere('table_name', 'structures')->orWhere('table_name', 'baux')->get();

        $champsFinal = session('champsFinal');
     
        return view('admin.blocs.locauxInf25', compact('page', 'locauxStructures', 'structures', 'champs', 'champsFinal', 'colonnes'));
    }

    public function updateColumns(Request $request)
    {   
        $page = 'locauxInf25'; 

        $data = (new LocauxInf25Controller)->dataLocauxInf25();

        $colonnes = $request->columns;
        $request->session()->put('columns', $colonnes);
       /* $index = array_search('ad_id', $colonnes); 
        array_splice($colonnes, $index, 1, array('test'));*/

        $locauxStructures = $data['local'];
        $structures = $data['structures'];

        DB::table('champsUpdate')
                ->whereIn('old_name', $colonnes)
                ->update(['status' => 1]);

        DB::table('champsUpdate')
                ->whereNotIn('old_name', $colonnes)
                ->update(['status' => 0]);

        $champs = DB::table('champsUpdate')->select('champsUpdate.*')->where('table_name', 'locaux')->orWhere('table_name', 'structures')->orWhere('table_name', 'baux')->get();

        session('columns') != null ? $colonnes = session('columns') : $colonnes = ['numero_ad', 'cp_local', 'ville_local', 'adresse_local', 'superficie'];
            ;

        $champsFinal = DB::table('champsUpdate')
                ->select('new_name', 'old_name')
                ->whereIn('old_name', $colonnes)
                ->get();

        $request->session()->put('champsFinal', $champsFinal);

        return view('admin.blocs.locauxInf25', compact('page', 'locauxStructures', 'structures', 'champs', 'champsFinal', 'colonnes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $page = 'locauxInf25';

        $data = (new LocauxInf25Controller)->dataLocauxInf25();

        $local = new Local;
        $bail = new Bail;

        $structures = $data['structures'];

        return view('admin.blocs.locauxInf25-edit-create', compact('page', 'local', 'structures', 'bail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocauxRequest $request)
    {
        dump($request->all()); die;
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
    public function edit($id)
    {   
        $page = 'locauxInf25';

        $data = (new LocauxInf25Controller)->dataLocauxInf25();

        $local = Local::find($id);

        switch ($local->info_bailleur) {
            case 'AN':
                $local->info_bailleur = '0';
                break;
            
            case 'privé' :
                $local->info_bailleur = '1';
                break;

            case 'publique' :
                $local->info_bailleur = '2';
                break;
        }
        
        $local->save();

        $structures = $data['structures'];

        $bail = Bail::findOrFail($local->bail_id);

        return view('admin.blocs.locauxInf25-edit-create', compact('page', 'local', 'structures', 'bail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocauxRequest $request, $id)
    {
        $page = 'locauxInf25';

        $local = Local::findOrFail($id);
        
        $updateLocal = [
            'ville_local' => $request->ville_local,
            'cp_local' => $request->cp_local,
            'adresse_local' => $request->adresse_local,
            'superficie' => $request->superficie,
            'ERP' => $request->ERP,
            'precaire' => $request->precaire,
            'nom_bailleur' => $request->nom_bailleur,
            'info_bailleur' => $request->info_bailleur,
            'loyer' => $request->loyer,
            'detail_loyer' => $request->detail_loyer,
            'pret' => $request->pret,
            'local_partage' => $request->local_partage,
            'precision_partage' => $request->precision_partage,
            'contenu' => $request->contenu,
            'accessibilite' => $request->accessibilite,
            'observation_generale' => $request->observation_generale,
            'charge_bailleur' => $request->charge_bailleur,
            'charge_rdc' => $request->charge_rdc,
            'detail_charge' => $request->detail_charge,
            'apptEscalier' => $request->apptEscalier,
            'complementGeographique' => $request->complementGeographique,
        ];

        $local->update( $updateLocal );

        $request->etat_ini == 0 ? $local->etat_ini = 'parfait état' : $local->etat_ini = 'remise en état fin de bail';

        switch ($local->info_bailleur) {
            case '0':
                $local->info_bailleur = 'AN';
                break;
            
            case '1' :
                $local->info_bailleur = 'privé';
                break;

            case '2' :
                $local->info_bailleur = 'publique';
                break;
        }

        $request->detail_loyer == 0 ? $local->detail_loyer = 'TVA' : $local->detail_loyer = 'NET';

        $local->save();
        //-------------------------------------//

        $structures = $request->type_structure? $request->type_structure : [];
        $local->structures()->sync($structures);

        //-------------------------------------//

        if ((strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE)) {
            
            $date_debut = date('Y-d-m', strtotime($request->date_debut));
            $date_signature = date('Y-d-m', strtotime($request->date_signature));
            $date_fin = date('Y-d-m', strtotime($request->date_fin));

        }else{
            $date_debut = $request->date_debut;
            $date_signature = $request->date_signature;
            $date_fin = $request->date_fin;
        }

        $bail = Bail::findOrFail($local->bail_id);
        $updateBail = [
            'type_document' => $request->type_document,
            'duree_ini' => $request->duree_ini,
            'tacite_reconduction' => $request->tacite_reconduction,
            'reconduction_description' => $request->reconduction_description,
            'description_clause' => $request->description_clause,
            'quantite_site' => $request->quantite_site,
            'date_debut' => $date_debut,
            'date_signature' => $date_signature,
            'date_fin' => $date_fin,
        ];

        $bail->update( $updateBail );

        $request->clause == 0 ? $bail->clause = 'résiliation' : $bail->clause = 'résolutoire';

        $bail->save();

        return redirect()
                ->route('locauxInf25RI.index')
                ->withSuccess('Le local a bien été modifié.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {      

        if ($request->date_resiliation == null) {
            
            return back()->withInput($request->only('motif'))->withErrors('Veuillez indiquer une date de résiliation');
        }

        $local = Local::find($id);
        $structures = $local->structures;

        //Suppression des données du local dans les différentes tables
        $array = [];
        foreach ($structures as $structure) {

            //On stock les type de structures du local avant suppression
            $array[] = $structure->type_structure;

            //On détache les structures liées au local
            $local->structures()->detach($structure->id);
        }

        //On converti le tableau en string
        $structures = implode(",", $array);

        //Insertion des données dans la table historiqueLocaux
        $historiqueLocal = DB::table('historiqueLocaux')->insert([
                            [   
                                'ad' => $local->ad->numero_ad, 
                                'ville_local' => $local->ville_local, 
                                'cp_local' => $local->cp_local, 
                                'adresse_local'=> $local->adresse_local, 
                                'apptEscalier'=> $local->apptEscalier, 
                                'complementGeographique'=> $local->complementGeographique, 
                                'superficie'=> $local->superficie, 
                                'structure'=> $structures,
                                'date_fin'=> $local->bail->date_fin ,
                                'date_resiliation'=> $request->date_resiliation, 
                                'motif'=> $request->motif
                            ] 

                            ]); 
 
        //suppression des contrats liés au local avec les sinistres associés (onDelete('cascade'))
        $contrats = Contrat::where('local_id', $id)->delete();

        //On supprime le local 
        $local = Local::destroy($id);

        return redirect(route('locauxInf25RI.index'))
            ->withSuccess('Le local à bien été supprimé.');
    }
}
