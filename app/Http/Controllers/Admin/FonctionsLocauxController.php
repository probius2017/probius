<?php

namespace App\Http\Controllers\Admin;

use Route;
use URL;
use DB;
use Response;
use App\Models\Ad;
use App\Models\Local;
use App\Models\Algeco;
use App\Models\Contrat;
use App\Models\Vehicule;
use App\Models\Structure;
use App\Models\Sinistre;
use App\Models\Logement;
use App\Models\Evenement;
use App\Http\Requests;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class FonctionsLocauxController extends Controller
{
    public function autocomplete(){

        $term = Str::lower(Input::get('term'));
        $results = array();

        $routeName = Route::currentRouteName();

       if ($routeName == 'rechercheVille') {
            
            $ville = Local::select('ville_local')
                        ->whereRaw('LOWER(ville_local) like ?', '%'.$term.'%');

            $searches = Algeco::select('ville_algeco as ville')
                        ->whereRaw('LOWER(ville_algeco) like ?', '%'.$term.'%')
                        ->union($ville)
                        ->take(6)
                        ->get();

            foreach ($searches as $search) {
              $results[] = $search->ville;
            }

        }elseif ($routeName == 'rechercheImmat') {

            $searche1 = Vehicule::select('immat')
                    ->whereRaw('LOWER(immat) like ?', '%'.$term.'%')
                    ->take(5)
                    ->get();

            foreach ($searche1 as $s1) {
                $results[] = $s1->immat;
            }

            $searche2 = Vehicule::select('old_immat')
                        ->whereRaw('LOWER(old_immat) like ?', '%'.$term.'%')
                        ->take(3)
                        ->get();

            foreach ($searche2 as $s2) {
                $results[] = $s2->old_immat;
            }

        }elseif ($routeName == 'rechercheRef') {
            
            $searche1 = Sinistre::select('ref_macif')
                    ->whereRaw('LOWER(ref_macif) like ?', '%'.$term.'%')
                    ->take(5)
                    ->get();

            foreach ($searche1 as $s1) {
                $results[] = $s1->ref_macif;
            }

        }elseif ($routeName == 'rechercheVilleSinistre') {
            
            $searche1 = Sinistre::select('ville_sinistre')
                    ->distinct()
                    ->whereRaw('LOWER(ville_sinistre) like ?', '%'.$term.'%')
                    ->take(5)
                    ->get();

            foreach ($searche1 as $s1) {
                $results[] = $s1->ville_sinistre;
            }
        }elseif ($routeName == 'rechercheVilleEvent') {
            
            $searche1 = Evenement::select('ville_event')
                    ->distinct()
                    ->whereRaw('LOWER(ville_event) like ?', '%'.$term.'%')
                    ->take(5)
                    ->get();

            foreach ($searche1 as $s1) {
                $results[] = $s1->ville_event;
            }
        }elseif ($routeName == 'rechercheNomEvent') {
            
            $searche1 = Evenement::select('nom_event')
                    ->distinct()
                    ->whereRaw('LOWER(nom_event) like ?', '%'.$term.'%')
                    ->take(5)
                    ->get();

            foreach ($searche1 as $s1) {
                $results[] = $s1->nom_event;
            }
        }else{
            $searches = Ad::distinct()
                        ->select('numero_ad')
                        ->whereRaw('LOWER(numero_ad) like ?', '%'.$term.'%')
                        ->orderBy('numero_ad')
                        ->take(5)
                        ->get();

            foreach ($searches as $search) {
              $results[] = $search->numero_ad;
            }
        }
    
        $return_array = array();

        foreach ($results as $k => $v) {
            
            if (strpos(Str::lower($v), $term) !== FALSE) {
                $return_array[] = array('value' => $v, 'id' =>$k);
            }
        }

        if(count($return_array))
            return Response::json($return_array);
        else
            return Response::json(['value'=>'Aucun résultat trouvé','id'=>'']);
    }

    public function dataLocaux(){
        
        $routePage = Route::current()->parameters();
        
        if ($routePage['page'] == 'Locaux') {
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];

            $entities = Local::where('date_delete', null)->get();
            $structures = Structure::all();
            $routeName = 'listeLocaux.index';

        }else if($routePage['page'] == 'ACI' && $routePage['info'] == '>50RI'){
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'intercalaire', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];

            $structures = Structure::where('RI', '>=50')->get();
            $contrats = Contrat::where('num_contrat', '9322933')->get();
            
            foreach ($contrats as $contrat) {

                $contratLocauxID[] = $contrat->local_id;
            }
            isset($contratLocauxID) ? $entities = Local::whereIn('id', $contratLocauxID)->where('date_delete', null)->get() : $entities = [];
            $routeName = 'listeACI.index';

        }else if($routePage['page'] == 'ACI' && $routePage['info'] == 'RCPRO'){
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'intercalaire', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];

            $structures = Structure::whereIn('type_structure', ['ACI (<=25)', 'ACI (>=50)', 'ACI (jardin - <=25)', 'ACI (jardin - >=50)'] )->get();

            $contrats = Contrat::where('num_contrat', '971 0000 94067 F 50')->get();

            foreach ($contrats as $contrat) {

                $contratLocauxID[] = $contrat->local_id;
            }

            isset($contratLocauxID) ? $entities = Local::whereIn('id', $contratLocauxID)->where('date_delete', null)->get() : $entities = [];
            $routeName = 'listeAciRCPRO.index';

        }elseif ($routePage['page'] == 'Entrepots') {

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'intercalaire', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];

            $structures = Structure::where('type_structure', 'Entrepot (>25)')->get();
            $contrats = Contrat::where('num_contrat', '9453148')->get();
            
            foreach ($contrats as $contrat) {

                $contratLocauxID[] = $contrat->local_id;
            }

            isset($contratLocauxID) ? $entities = Local::whereIn('id', $contratLocauxID)->where('date_delete', null)->get() : $entities = [];
            $routeName = 'listeEntrepots.index';

        }elseif ($routePage['page'] == 'AN') {

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'intercalaire', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];

            $structures = Structure::where('type_structure', 'Bien AN')->get();
            $contrats = Contrat::where('num_contrat', '6665737')->get();
        
            foreach ($contrats as $contrat) {

                $contratLocauxID[] = $contrat->local_id;
            }

            isset($contratLocauxID) ? $entities = Local::whereIn('id', $contratLocauxID)->where('date_delete', null)->get() : $entities = [];
            $routeName = 'listeBiensAN.index';

        }elseif ($routePage['page'] == 'Chambres-froides') {

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'cp_local', 'ville_local', 'adresse_local', 'id'];

            $structures = [];
            $contrats = Contrat::where('num_contrat', '9453062')->get();
        
            foreach ($contrats as $contrat) {

                $contratLocauxID[] = $contrat->local_id;
            }

            isset($contratLocauxID) ? $entities = Local::whereIn('id', $contratLocauxID)->get() : $entities = [];
            $routeName = 'listeChambresFroides.index';

        }elseif ($routePage['page'] == 'Algecos') {

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'intercalaire', 'cp_algeco', 'ville_algeco', 'adresse_algeco', 'type_algeco', 'id', 'bail_id'];

            $structures = [];
            $contrats = Contrat::where('num_contrat', '9453755')->get();
        
            foreach ($contrats as $contrat) {

                $contratAlgecosID[] = $contrat->algeco_id;
            }

            isset($contratAlgecosID) ? $entities = Algeco::whereIn('id', $contratAlgecosID)->where('date_delete', null)->get() : $entities = [];
            $routeName = 'listeAlgecos.index';

        }elseif ($routePage['page'] == 'Vehicules') {

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'type', 'reference', 'name_marque', 'name_modele', 'immat', 'id'];

            $structures = [];
            $entities = Vehicule::where('date_delete', null)->get();
            $routeName = 'listeVehicules.index';

        }elseif ($routePage['page'] == 'Evenements') {

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['nom_salle', 'adresse_event', 'cp_event','ville_event', 'nom_event', 'duree_event', 'type_event', 'statut_event' ,'date_demande', 'date_reponse', 'remarque'];

            $structures = [];
            $entities = Evenement::all();
            $routeName = 'listeEvenements.index';

        }elseif ($routePage['page'] == 'Sinistres' && $routePage['info'] == 'Véhicules') {

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'date_cloture', 'ville_sinistre', 'ref', 'name_marque', 'immat','id'];

            $structures = [];
            $entities = Sinistre::whereNull('contrat_id')
                    ->whereNotNull('contrat_v_id')
                    ->orderBy('ref_rdc', 'asc')
                    ->orderBy('contrat_v_id', 'asc')
                    ->get();
            $routeName = 'listeSinistresVehicules.index';

        }elseif ($routePage['page'] == 'Sinistres' && $routePage['info'] == 'Mas') {

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'date_cloture', 'ville_sinistre', 'ref', 'num_contrat', 'intercalaire','id'];

            $structures = [];
            $entities = Sinistre::whereNull('contrat_v_id')
                    ->whereNotNull('contrat_id')
                    ->orderBy('ref_rdc', 'asc')
                    ->orderBy('contrat_id', 'asc')
                    ->get();
            $routeName = 'listeSinistresMasse.index';
        }

        $array = ['entities' => $entities, 'structures' => $structures, 'routeName' => $routeName, 'colonnes' => $colonnes];

        return $array;
    }

    public function updateColumns(Request $request, $p, $ps){   
        
        $data = (new FonctionsLocauxController)->dataLocaux();

        $request->session()->forget('columns');
        //$request->session()->forget('champsFinal');

        $page = $p;
        $pageSmall = $ps;
        $routeName = $data['routeName'];
        $routeName2 = Route::currentRouteName();

        if (empty($request->columns)) {
            
            if($page == 'Chambres-froides'){

                $colonnes = ['ad_id', 'cp_local', 'ville_local', 'adresse_local', 'id'];

            }elseif ($page == 'Algecos') {

                $colonnes = ['ad_id', 'intercalaire', 'cp_algeco', 'ville_algeco', 'adresse_algeco', 'type_algeco', 'id', 'bail_id'];

            }elseif ($page == 'Vehicules') {

                $colonnes = ['ad_id', 'type', 'reference', 'name_marque', 'name_modele', 'immat', 'id'];

            }elseif ($page == 'Evenements') {

                $colonnes = ['nom_salle', 'adresse_event', 'cp_event','ville_event', 'nom_event', 'duree_event', 'type_event', 'statut_event' ,'date_demande', 'date_reponse', 'remarque'];

            }elseif ($page == 'Sinistres' && $pageSmall == 'Véhicules') {

                $colonnes = ['ad_id', 'ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'date_cloture', 'ville_sinistre', 'ref', 'name_marque', 'immat','id'];

            }elseif ($page == 'Sinistres' && $pageSmall == 'Mas') {

                $colonnes = ['ad_id', 'ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'date_cloture', 'ville_sinistre', 'ref', 'num_contrat', 'intercalaire','id'];

            }else{

                $colonnes = ['ad_id', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];
            }
        }
        else{

            $colonnes = $request->columns;

            if($page == 'Chambres-froides' || $page == 'Evenements'){
                array_push($colonnes, 'id');

            }elseif($page == 'Vehicules' || $page == 'Sinistres' || $routeName2 == 'filterSinistresByref' ){
                array_push($colonnes, 'id', 'ad_id');

            }else{
                array_push($colonnes, 'id', 'ad_id', 'bail_id');
            }
        }
        
        $request->session()->put('columns', $colonnes);

        $structures = $data['structures'];

        DB::table('champsUpdate')
                    ->whereIn('old_name', $colonnes)
                    ->update(['status' => 1]);

        DB::table('champsUpdate')
            ->whereNotIn('old_name', $colonnes)
            ->update(['status' => 0]);

        if ($page == 'Locaux') {
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];

            session('entities') != null ? $entities = session('entities') : $entities = $data['entities'];
            
            $champs = DB::table('champsUpdate')
                ->where('table_name', 'locaux')
                ->orWhere('table_name', 'baux')
                ->get();

            $champsFinal = DB::table('champsUpdate')
                    ->select('new_name', 'old_name', 'table_name')
                    ->whereIn('old_name', $colonnes)
                    ->get(); 


        }elseif ($page == 'ACI' || $page == 'Entrepots' || $page == 'AN') {
         
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'intercalaire', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'type_structure'];
            
            session('entities') != null ? $entities = session('entities') : $entities = $data['entities'];

            $champs = DB::table('champsUpdate')
                ->where('table_name', 'locaux')
                ->orWhere('table_name', 'baux')
                ->orWhere('table_name', 'contrats')
                ->get();

            $champsFinal = DB::table('champsUpdate')
                    ->select('new_name', 'old_name', 'table_name')
                    ->whereIn('old_name', $colonnes)
                    ->get(); 

        }elseif ($page == 'Chambres-froides') {
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'cp_local', 'ville_local', 'adresse_local', 'id'];

            session('entities') != null ? $entities = session('entities') : $entities = $data['entities'];

            $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['cp_local', 'ville_local', 'adresse_local', 'num_contrat'])
                ->get();

            $champsFinal = DB::table('champsUpdate')
                    ->select('new_name', 'old_name', 'table_name')
                    ->whereIn('old_name', $colonnes)
                    ->get(); 

        }elseif ($page == 'Algecos') {
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'intercalaire', 'cp_algeco', 'ville_algeco', 'adresse_algeco', 'type_algeco', 'id', 'bail_id'];

            session('entities') != null ? $entities = session('entities') : $entities = $data['entities'];

            $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['cp_algeco', 'ville_algeco', 'adresse_algeco', 'type_algeco', 'num_contrat', 'intercalaire', 'complementGeographique', 'apptEscalier'])
                ->get();

            $champsFinal = DB::table('champsUpdate')
                    ->select('new_name', 'old_name', 'table_name')
                    ->whereIn('old_name', $colonnes)
                    ->get(); 

        }elseif ($page == 'Vehicules') {
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'type', 'reference', 'name_marque', 'name_modele', 'immat', 'id'];

            session('entities') != null ? $entities = session('entities') : $entities = $data['entities'];

            $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['type', 'name_marque', 'name_modele', 'immat', 'old_immat', 'pmc', 'atp', 'numero_contratV', 'reference'])
                ->get();

            $champsFinal = DB::table('champsUpdate')
                    ->select('new_name', 'old_name', 'table_name')
                    ->whereIn('old_name', $colonnes)
                    ->get(); 

        }elseif ($page == 'Evenements') {
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['nom_salle', 'adresse_event', 'cp_event','ville_event', 'nom_event', 'duree_event', 'type_event', 'statut_event' ,'date_demande', 'date_reponse', 'remarque'];

            session('entities') != null ? $entities = session('entities') : $entities = $data['entities'];

            $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['nom_salle', 'adresse_event', 'cp_event','ville_event', 'nom_event', 'duree_event', 'type_event', 'statut_event' ,'date_demande', 'date_reponse', 'remarque'])
                ->get();

            $champsFinal = DB::table('champsUpdate')
                    ->select('new_name', 'old_name', 'table_name')
                    ->whereIn('old_name', $colonnes)
                    ->get(); 

        }elseif ($page == 'Sinistres' && $pageSmall == 'Véhicules' || $routeName2 == 'filterSinistresByref') {
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'date_cloture', 'ville_sinistre', 'ref', 'name_marque', 'immat','id'];

            session('entities') != null ? $entities = session('entities') : $entities = $data['entities'];

            $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'ville_sinistre', 'ref', 'name_marque', 'immat', 'reference', 'responsabilite', 'observation', 'reglement_macif', 'franchise', 'solde_ad', 'date_cloture'])
                ->get();

            $champsFinal = DB::table('champsUpdate')
                    ->select('new_name', 'old_name', 'table_name')
                    ->whereIn('old_name', $colonnes)
                    ->get(); 

        }elseif ($page == 'Sinistres' && $pageSmall == 'Mas' || $routeName2 == 'filterSinistresByref') {
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'date_cloture', 'ville_sinistre', 'ref', 'num_contrat', 'intercalaire','id'];

            session('entities') != null ? $entities = session('entities') : $entities = $data['entities'];

            $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'ville_sinistre', 'ref', 'num_contrat', 'intercalaire', 'responsabilite', 'observation', 'reglement_macif', 'franchise', 'solde_ad', 'date_cloture'])
                ->get();

            $champsFinal = DB::table('champsUpdate')
                    ->select('new_name', 'old_name', 'table_name')
                    ->whereIn('old_name', $colonnes)
                    ->get(); 
        }

        $request->session()->put('champsFinal', $champsFinal);

        return view('admin.blocs.entities', compact('page', 'pageSmall', 'entities', 'structures', 'champs', 'champsFinal', 'colonnes', 'routeName'));
    }

    public function filters(Request $request, $p, $ps){   
        
        $data = (new FonctionsLocauxController)->dataLocaux();
        //dump($request->all()); die;
        $page = $p;
        $pageSmall = $ps;
        $routeName = $data['routeName'];
        //$uri = URL::route($routeName, [$page, $pageSmall], false);

        $villeLocal = $request->ville_local;
        $villeAlgeco = $request->ville_algeco;
        $villeSinistre = $request->ville_sinistre;
        $villeEvent = $request->ville_event;
        $immat = $request->immat;
        $refMacif = $request->ref_macif;
        $nomEvent = $request->nom_event;
        $statutEvent = $request->statut_event;
        $typeEvent = $request->type_event;
        $structureID = $request->type_structure;
            //Je recherche la structure via le type de structure recup en POST
            $structure = Structure::find($structureID);
            //$structure = Structure::where('id', $typeStructure)->get();
        $numAd = $request->numero_ad;
            //Je recherche l'Ad via le numero ad récupérer en méthode POST
            $ad = Ad::where('numero_ad', $numAd)->first();

        if($request->has('ville_local') && $request->has('type_structure') && $request->has('numero_ad')){

            $locaux = $structure->locaux->where('ad_id', $ad->id)->where('ville_local', $villeLocal);

            if ($locaux->isNotEmpty()) {
                $entities = $locaux;
                $request->session()->put('entities', $entities);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'existe pas de local pour cette recherche');
            }
          
        }else if ($request->has('ville_local') && $request->has('type_structure')){
           
            $locaux = $structure->locaux->where('ville_local', $villeLocal);

            if ($locaux->isNotEmpty()) {
                $entities = $locaux;
                $request->session()->put('entities', $entities);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'existe pas de local pour cette recherche');
            }
       
        }else if ($request->has('ville_local') && $request->has('numero_ad')){

            !empty($data['entities']) ? $locaux = $data['entities']
                    ->where('ad_id', $ad->id)
                    ->where('ville_local', $villeLocal)
                    ->where('ville_algeco', $villeAlgeco) : [];

            if ($locaux->isNotEmpty()) {
                $entities = $locaux;
                $request->session()->put('entities', $entities);

            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'existe pas de local pour cette recherche');
            }

        }else if ($request->has('ville_algeco') && $request->has('numero_ad')){

            !empty($data['entities']) ? $algecos = $data['entities']
                    ->where('ad_id', $ad->id)
                    ->where('ville_algeco', $villeAlgeco) : [];

            if ($algecos->isNotEmpty()) {
                $entities = $algecos;
                $request->session()->put('entities', $entities);

            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'existe pas de local pour cette recherche');
            }

        }else if ($request->has('type_structure') && $request->has('numero_ad')){
            
            $locaux = $structure->locaux->where('ad_id', $ad->id);

            if ($locaux->isNotEmpty()) {
                $entities = $locaux;
                $request->session()->put('entities', $entities);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'existe pas de local pour cette recherche');
            }

        }else if ($request->has('type_structure')){

            $structures = $data['structures'];

            $locaux = $structure->locaux;
          
            if ($locaux->isNotEmpty()) {
                $entities = $locaux;
                $request->session()->put('entities', $entities);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'a pas de locaux pour ce type de structure');
            }

        }else if ($request->has('ville_local') || $request->has('ville_algeco')){

            !empty($data['entities']) ? $ent = $data['entities']->where('ville_local', $villeLocal)->where('ville_algeco', $villeAlgeco) : [];

            if ($ent->isNotEmpty()) {
                $entities = $ent;
                $request->session()->put('entities', $entities);

            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('La ville recherchée ne possède aucun local/algéco pour ce contrat');
            }

        }else if ($request->has('ville_sinistre')) {
            
            !empty($data['entities']) ? $sinistres = $data['entities']->where('ville_sinistre', $villeSinistre) : [];

            if ($sinistres->isNotEmpty()) {
                $entities = $sinistres;
                $request->session()->put('entities', $entities);

            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('il n\'existe pas de sinistre pour cette ville');
            }

        }else if ($request->has('ville_event') && $request->has('nom_event')) {

            !empty($data['entities']) ? $evenements = $data['entities']->where('ville_event', $villeEvent)->where('nom_event', $nomEvent) : [];

            if ($evenements->isNotEmpty()) {
                $entities = $evenements;
                $request->session()->put('entities', $entities);

            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('il n\'existe pas d\'évènement(s) pour cette recherche.');
            }

        }else if ($request->has('ville_event') && $request->has('type_event')) {

            !empty($data['entities']) ? $evenements = $data['entities']->where('ville_event', $villeEvent)->where('type_event', $typeEvent) : [];

            if ($evenements->isNotEmpty()) {
                $entities = $evenements;
                $request->session()->put('entities', $entities);

            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('il n\'existe pas d\'évènement(s) pour cette recherche.');
            }

        }else if ($request->has('ville_event') && $request->has('statut_event')) {

            !empty($data['entities']) ? $evenements = $data['entities']->where('ville_event', $villeEvent)->where('statut_event', $statutEvent) : [];

            if ($evenements->isNotEmpty()) {
                $entities = $evenements;
                $request->session()->put('entities', $entities);

            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('il n\'existe pas d\'évènement(s) pour cette recherche.');
            }

        }else if ($request->has('ville_event')) {
            !empty($data['entities']) ? $evenements = $data['entities']->where('ville_event', $villeEvent) : [];

            if ($evenements->isNotEmpty()) {
                $entities = $evenements;
                $request->session()->put('entities', $entities);

            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('il n\'existe pas d\'évènement(s) pour cette ville');
            }

        }else if ($request->has('numero_ad')){
            
            if ($page == 'Sinistres' && $pageSmall == 'Véhicules') {
            
                $sinistres = Sinistre::join('vehicules', 'vehicules.contrat_v_id', '=', 'sinistres.contrat_v_id' )
                            ->where('ad_id', $ad->id)
                            ->get();
            
                if ($sinistres->isNotEmpty()) {
                    $entities = $sinistres;
                    $request->session()->put('entities', $entities);
                }else{

                    return redirect()
                            ->route($routeName, [$page, $pageSmall])
                            ->withErrors('L\'AD recherchée ne possède pas de sinistre');
                }
            }elseif ($page == 'Sinistres' && $pageSmall == 'Mas') {
                
                $locaux = $ad->locaux;
                $algecos = $ad->algecos;
                $logements = $ad->logements;

                //Je regroupe toutes les collections '$locaux, $algecos, ..) pour en former qu'une seule
                $dataEntities = $locaux->merge($algecos)->merge($logements);

                //J'instencie une nouvelle collection
                $sinistres = new \Illuminate\Database\Eloquent\Collection;

                //A chaque tour de boucle je merge les collections pour en former qu'une seule
                foreach ($dataEntities as $entity) {

                    $sinistresByentity = $entity->sinistres; 
                    $sinistres = $sinistres->merge($sinistresByentity);
                }
                //$entities = $sinistres->toArray(); 

                if ($sinistres->isNotEmpty()) {
                        $entities = $sinistres;
                        $request->session()->put('entities', $entities);
                }else{

                    return redirect()
                            ->route($routeName, [$page, $pageSmall])
                            ->withErrors('L\'AD recherchée ne possède pas de sinistre(s)');
                }
       
            }else{

                !empty($data['entities']) ? $entities = $data['entities']->where('ad_id', $ad->id)->toArray() : [];
            
                if (!empty($entities)) {
                    $entities = $data['entities']->where('ad_id', $ad->id);
                    $request->session()->put('entities', $entities);
                }else{

                    return redirect()
                            ->route($routeName, [$page, $pageSmall])
                            ->withErrors('L\'AD recherchée ne possède aucun local pour ce contrat');
                }
            }
               
        }else if ($request->has('immat')){

            if ($page == 'Sinistres' && $pageSmall == 'Véhicules') {
            
                $sinistres = Sinistre::join('vehicules', 'vehicules.contrat_v_id', '=', 'sinistres.contrat_v_id' )
                            ->where('immat', $immat)
                            ->get();
                //!empty($data['entities']) ? $sinistres = $data['entities']->where('immat', $immat) : [];

                if ($sinistres->isNotEmpty()) {
                    $entities = $sinistres;
                    $request->session()->put('entities', $entities);
                }else{

                    return redirect()
                            ->route($routeName, [$page, $pageSmall])
                            ->withErrors('Il n\'y a pas de sinistre pour ce n° d\'immat.');
                }

            }else{
                !empty($data['entities']) ? $vehicules = $data['entities']->where('immat', $immat) : [];

                if ($vehicules->isNotEmpty()) {
                    $entities = $vehicules;
                    $request->session()->put('entities', $entities);
                }else{

                    return redirect()
                            ->route($routeName, [$page, $pageSmall])
                            ->withErrors('Il n\' exsite pas de véhicule pour ce numéro d\'immatriculation');
                }
            }

        }else if ($request->has('nom_event')){

            $evenements = $data['entities']->where('nom_event', $nomEvent);

            if ($evenements->isNotEmpty()) {
                $entities = $evenements;
                $request->session()->put('entities', $entities);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('il n\'existe pas d\'évènement(s) pour ce nom');
            }

        }else if ($request->has('type_event')){

            $evenements = $data['entities']->where('type_event', $typeEvent);

            if ($evenements->isNotEmpty()) {
                $entities = $evenements;
                $request->session()->put('entities', $entities);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('il n\'existe pas d\'évènement(s) pour ce type');
            }

        }else if ($request->has('statut_event')){

            $evenements = $data['entities']->where('statut_event', $statutEvent);

            if ($evenements->isNotEmpty()) {
                $entities = $evenements;
                $request->session()->put('entities', $entities);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('il n\'existe pas d\'évènement(s) pour ce type');
            }

        }else if ($request->has('ref_macif')) {
            
            !empty($data['entities']) ? $sinistres = $data['entities']->where('ref_macif', $refMacif) : [];

            if ($sinistres->isNotEmpty()) {
                $entities = $sinistres;
                $request->session()->put('entities', $entities);

            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('il n\'existe pas de sinistre pour cette référence MACIF');
            }

        }else if ($request->has('ref_macif') && $request->has('ville_sinistre')) {
            
            !empty($data['entities']) ? $sinistres = $data['entities']->where('ref_macif', $refMacif)->where('ville_sinistre', $villeSinistre) : [];

            if ($sinistres->isNotEmpty()) {
                $entities = $sinistres;
                $request->session()->put('entities', $entities);

            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('il n\'existe pas de sinistre pour cette recherche');
            }

        }else if ($request->has('ref_macif') && $request->has('numero_ad')) {
            
                $locaux = $ad->locaux;
                $algecos = $ad->algecos;
                $logements = $ad->logements;

                $dataEntities = $locaux->merge($algecos)->merge($logements);

                $sinistres = new \Illuminate\Database\Eloquent\Collection;

                foreach ($dataEntities as $entity) {

                    $sinistresByentity = $entity->sinistres; 
                    $sinistresAll = $sinistres->merge($sinistresByentity);
                }
                $sinistres = $sinistres->where('ref_macif', $refMacif); 

                if ($sinistres->isNotEmpty()) {
                        $entities = $sinistres;
                        $request->session()->put('entities', $entities);
                }else{

                    return redirect()
                            ->route($routeName, [$page, $pageSmall])
                            ->withErrors('il n\'existe pas de sinistre pour cette recherche');
                }
        }else if ($request->has('ville_sinistre') && $request->has('numero_ad')) {
            
                $locaux = $ad->locaux;
                $algecos = $ad->algecos;
                $logements = $ad->logements;

                $dataEntities = $locaux->merge($algecos)->merge($logements);

                $sinistres = new \Illuminate\Database\Eloquent\Collection;

                foreach ($dataEntities as $entity) {

                    $sinistresByentity = $entity->sinistres; 
                    $sinistresAll = $sinistres->merge($sinistresByentity);
                }
                $sinistres = $sinistres->where('ville_sinistre', $villeSinistre); 

                if ($sinistres->isNotEmpty()) {
                        $entities = $sinistres;
                        $request->session()->put('entities', $entities);
                }else{

                    return redirect()
                            ->route($routeName, [$page, $pageSmall])
                            ->withErrors('il n\'existe pas de sinistre pour cette recherche');
                }
        }else if ($request->has('ville_sinistre') && $request->has('numero_ad') && $request->has('ref_macif')) {
            
                $locaux = $ad->locaux;
                $algecos = $ad->algecos;
                $logements = $ad->logements;

                $dataEntities = $locaux->merge($algecos)->merge($logements);

                $sinistres = new \Illuminate\Database\Eloquent\Collection;

                foreach ($dataEntities as $entity) {

                    $sinistresByentity = $entity->sinistres; 
                    $sinistresAll = $sinistres->merge($sinistresByentity);
                }
                $sinistres = $sinistres->where('ville_sinistre', $villeSinistre)->where('ref_macif', $refMacif); 

                if ($sinistres->isNotEmpty()) {
                        $entities = $sinistres;
                        $request->session()->put('entities', $entities);
                }else{

                    return redirect()
                            ->route($routeName, [$page, $pageSmall])
                            ->withErrors('il n\'existe pas de sinistre pour cette recherche');
                }
        }else{
            $request->session()->forget('entities');
            $entities = $data['entities'];
        }

        $structures = $data['structures'];

        if($page == 'Locaux' ){

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];

            $champs = DB::table('champsUpdate')
                ->where('table_name', 'locaux')
                ->orWhere('table_name', 'baux')
                ->get();

        }elseif($page == 'ACI' || $page == 'Entrepots' || $page == 'AN'){

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'intercalaire', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];

            $champs = DB::table('champsUpdate')
                ->where('table_name', 'locaux')
                ->orWhere('table_name', 'baux')
                ->orWhere('table_name', 'contrats')
                ->get();

        }elseif ($page == 'Chambres-froides') {
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'cp_local', 'ville_local', 'adresse_local', 'id'];

            $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['cp_local', 'ville_local', 'adresse_local', 'num_contrat'])
                ->get();

        }elseif ($page == 'Algecos') {
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'intercalaire', 'cp_algeco', 'ville_algeco', 'adresse_algeco', 'type_algeco', 'id', 'bail_id'];

            $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['cp_algeco', 'ville_algeco', 'adresse_algeco', 'type_algeco', 'num_contrat', 'intercalaire', 'complementGeographique', 'apptEscalier'])
                ->get();

        }elseif ($page == 'Vehicules') {
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'type', 'reference', 'name_marque', 'name_modele', 'immat', 'id'];

            $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['type', 'name_marque', 'name_modele', 'immat', 'old_immat', 'pmc', 'atp', 'numero_contratV', 'reference'])
                ->get();

        }elseif ($page == 'Evenements') {
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['nom_salle', 'adresse_event', 'cp_event','ville_event', 'nom_event', 'duree_event', 'type_event', 'statut_event' ,'date_demande', 'date_reponse', 'remarque'];

            $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['nom_salle', 'adresse_event', 'cp_event','ville_event', 'nom_event', 'duree_event', 'type_event', 'statut_event' ,'date_demande', 'date_reponse', 'remarque'])
                ->get();

        }elseif ($page == 'Sinistres' && $pageSmall == 'Véhicules') {
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'date_cloture', 'ville_sinistre', 'ref', 'name_marque', 'immat','id'];

            $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'ville_sinistre', 'ref', 'name_marque', 'immat', 'reference', 'responsabilite', 'observation', 'reglement_macif', 'franchise', 'solde_ad', 'date_cloture'])
                ->get();

        }elseif ($page == 'Sinistres' && $pageSmall == 'Mas') {
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'date_cloture', 'ville_sinistre', 'ref', 'num_contrat', 'intercalaire','id'];

            $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'ville_sinistre', 'ref', 'num_contrat', 'intercalaire', 'responsabilite', 'observation', 'reglement_macif', 'franchise', 'solde_ad', 'date_cloture'])
                ->get();
        }
    
        $champsFinal = DB::table('champsUpdate')
                    ->select('new_name', 'old_name', 'table_name')
                    ->whereIn('old_name', $colonnes)
                    ->get(); 

        return view('admin.blocs.entities', compact('page', 'pageSmall', 'entities', 'structures', 'champs', 'champsFinal', 'colonnes', 'routeName'));
    }

    public function clotureSinistre(Request $request, $p, $ps, $id){

        $data = (new FonctionsLocauxController)->dataLocaux();

        $page = $p;
        $pageSmall = $ps;

        $routeName = $data['routeName'];

        $sinistre = Sinistre::findOrFail($id);
        $sinistre->date_cloture = $request->date_cloture;
        $sinistre->save(); 

        return redirect()
                ->route($routeName, [$page, $pageSmall])
                ->withSuccess('Le sinistre est bien cloturé.');
    }

    public function listeRefSinistresByEntity($p, $ps, $id){

        if ($p == 'Locaux') {
            $sinistres = Local::join('contrats', function($join){
                            $join->on('locaux.id', '=', 'contrats.local_id');
                        })
                        ->join('sinistres', function($join){
                            $join->on('contrats.id', '=', 'sinistres.contrat_id');
                        })
                        ->where('locaux.id', $id)
                        ->get();
                        
        }elseif ($p == 'Algecos') {
            $entity = Algeco::findOrFail($id);
            $sinistres = $entity->sinistres; 
        }elseif ($p == 'Chambres-froides') {
            $entity = Local::findOrFail($id); 
            $sinistres = $entity->sinistres;
        }elseif ($p == 'Logements') {
            $entity = Logement::findOrFail($id);
            $sinistres = $entity->sinistres;
        }/*elseif ($p == 'Evènements') {
            $entity = Evenement::findOrFail($id);
            $sinistres = $entity->sinistres;
        }*/elseif ($p == 'Vehicules') {
            $entity = Vehicule::findOrFail($id);
            $sinistres = $entity->contratV->sinistres;
        }

        return Response::json($sinistres);
    }

    public function filterSinistresByref(Request $request){
        
        $entities = Sinistre::whereIn('id', $request->sinistresID)->get();
        $request->session()->put('entities', $entities);

        $page = 'Sinistres';
        $structures = [];

        foreach ($entities as $entity) {
            
            if ($entity->contrat_v_id != null) {
            
                $pageSmall = 'Véhicules';
                $routeName = 'listeSinistresVehicules.index';

                session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'date_cloture', 'ville_sinistre', 'ref', 'name_marque', 'immat','id'];

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

            }elseif ($entity->contrat_id != null) {
                
                $pageSmall = 'Mas';
                $routeName = 'listeSinistresMasse.index';

                session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'date_cloture', 'ville_sinistre', 'ref', 'num_contrat', 'intercalaire','id'];

                DB::table('champsUpdate')
                    ->whereIn('old_name', $colonnes)
                    ->update(['status' => 1]);

                DB::table('champsUpdate')
                    ->whereNotIn('old_name', $colonnes)
                    ->update(['status' => 0]);

                $champs = DB::table('champsUpdate')
                    ->select('new_name', 'old_name', 'status')
                    ->whereIn('old_name', ['ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'ville_sinistre', 'ref', 'num_contrat', 'intercalaire', 'responsabilite', 'observation', 'reglement_macif', 'franchise', 'solde_ad', 'date_cloture'])
                    ->get();
            }
        }
        
    
        $champsFinal = DB::table('champsUpdate')
                    ->select('new_name', 'old_name', 'table_name')
                    ->whereIn('old_name', $colonnes)
                    ->get(); 

        return view('admin.blocs.entities', compact('page', 'pageSmall', 'entities', 'structures', 'champs', 'champsFinal', 'colonnes', 'routeName'));
    }

}
