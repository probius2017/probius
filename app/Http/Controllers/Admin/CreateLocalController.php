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

class CreateLocalController extends Controller
{
    public function create(){

    	$page = 'createEntity';
        $pageSmall = 'Local';

        $local = new Local;
        $bail = new Bail;

        $contrat = new Contrat;

        $structures = Structure::distinct()->get();

        return view('admin.blocs.locaux-edit-create', compact('page', 'pageSmall', 'local', 'structures', 'bail'));
    }

    public function store(LocauxRequest $request){

        dump($request->all()); die;

        /*if ((strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE)) {
            
            $date_debut = date('Y-d-m', strtotime($request->date_debut));
            $date_signature = date('Y-d-m', strtotime($request->date_signature));
            $date_fin = date('Y-d-m', strtotime($request->date_fin));

        }else{
            $date_debut = $request->date_debut;
            $date_signature = $request->date_signature;
            $date_fin = $request->date_fin;
        }*/

        //Création du bail associé au local
        $createBail = [
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

        $bail = Bail::create( $createBail );

        $request->clause == 0 ? $bail->clause = 'résiliation' : $bail->clause = 'résolutoire';

        $bail->save();

        //création du local
        $dataLocal = [
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

        $local = Local::create( $dataLocal );

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

        //On relie la/les structure(s) du local
        $structures = $request->type_structure? $request->type_structure : [];
        $local->structures()->attach($structures);

        //-------------------------------------//

        

        //On créer les différents contrats du local en fonction structure(s)





        return redirect()
                ->route('locauxInf25RI.index')
                ->withSuccess('Le local a bien été modifié.');
    }
}
