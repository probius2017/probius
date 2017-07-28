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

            $entities = Local::all();
            $structures = Structure::all();
            $routeName = 'listeLocaux.index';

        }else if($routePage['page'] == 'ACI' && $routePage['info'] == '>50RI'){
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'intercalaire', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];

            $structures = Structure::where('RI', '>=50')->get();
            $contrats = Contrat::where('num_contrat', '9322933')->get();
            
            foreach ($contrats as $contrat) {

                $contratLocauxID[] = $contrat->local_id;
            }
            isset($contratLocauxID) ? $entities = Local::whereIn('id', $contratLocauxID)->get() : $entities = [];
            $routeName = 'listeACI.index';

        }else if($routePage['page'] == 'ACI' && $routePage['info'] == 'RCPRO'){
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'intercalaire', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];

            $structures = Structure::whereIn('type_structure', ['ACI (<=25)', 'ACI (>=50)', 'ACI (jardin - <=25)', 'ACI (jardin - >=50)'] )->get();

            $contrats = Contrat::where('num_contrat', '971 0000 94067 F 50')->get();

            foreach ($contrats as $contrat) {

                $contratLocauxID[] = $contrat->local_id;
            }

            isset($contratLocauxID) ? $entities = Local::whereIn('id', $contratLocauxID)->get() : $entities = [];
            $routeName = 'listeAciRCPRO.index';

        }elseif ($routePage['page'] == 'Entrepots') {

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'intercalaire', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];

            $structures = Structure::where('type_structure', 'Entrepot (>25)')->get();
            $contrats = Contrat::where('num_contrat', '9453148')->get();
            
            foreach ($contrats as $contrat) {

                $contratLocauxID[] = $contrat->local_id;
            }

            isset($contratLocauxID) ? $entities = Local::whereIn('id', $contratLocauxID)->get() : $entities = [];
            $routeName = 'listeEntrepots.index';

        }elseif ($routePage['page'] == 'AN') {

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'intercalaire', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];

            $structures = Structure::where('type_structure', 'Bien AN')->get();
            $contrats = Contrat::where('num_contrat', '6665737')->get();
        
            foreach ($contrats as $contrat) {

                $contratLocauxID[] = $contrat->local_id;
            }

            isset($contratLocauxID) ? $entities = Local::whereIn('id', $contratLocauxID)->get() : $entities = [];
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

            isset($contratAlgecosID) ? $entities = Algeco::whereIn('id', $contratAlgecosID)->get() : $entities = [];
            $routeName = 'listeAlgecos.index';

        }elseif ($routePage['page'] == 'Vehicules') {

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'type', 'reference', 'name_marque', 'name_modele', 'immat', 'id'];

            $structures = [];
            $entities = Vehicule::where('date_delete', null)->get();
            $routeName = 'listeVehicules.index';

        }elseif ($routePage['page'] == 'Sinistres' && $routePage['info'] == 'Véhicules') {

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'date_cloture', 'ville_sinistre', 'ref', 'name_marque', 'immat','id'];

            $structures = [];
            $entities = Sinistre::whereNull('contrat_id')
                    ->whereNotNull('contrat_v_id')
                    ->get();
            $routeName = 'listeSinistresVehicules.index';

        }elseif ($routePage['page'] == 'Sinistres' && $routePage['info'] == 'Masse') {

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'date_cloture', 'ville_sinistre', 'ref', 'num_contrat', 'intercalaire','id'];

            $structures = [];
            $entities = Sinistre::whereNull('contrat_v_id')
                    ->whereNotNull('contrat_id')
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

        if (empty($request->columns)) {
            
            if($page == 'Chambres-froides'){

                $colonnes = ['ad_id', 'cp_local', 'ville_local', 'adresse_local', 'id'];

            }elseif ($page == 'Algecos') {

                $colonnes = ['ad_id', 'intercalaire', 'cp_algeco', 'ville_algeco', 'adresse_algeco', 'type_algeco', 'id', 'bail_id'];

            }elseif ($page == 'Vehicules') {

                $colonnes = ['ad_id', 'type', 'reference', 'name_marque', 'name_modele', 'immat', 'id'];

            }elseif ($page == 'Sinistres' && $pageSmall == 'Véhicules') {

                $colonnes = ['ad_id', 'ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'date_cloture', 'ville_sinistre', 'ref', 'name_marque', 'immat','id'];

            }elseif ($page == 'Sinistres' && $pageSmall == 'Masse') {

                $colonnes = ['ad_id', 'ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'date_cloture', 'ville_sinistre', 'ref', 'num_contrat', 'intercalaire','id'];

            }else{

                $colonnes = ['ad_id', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];
            }
        }
        else{

            $colonnes = $request->columns;

            if($page == 'Chambres-froides'){
                array_push($colonnes, 'id');

            }elseif($page == 'Vehicules' || $page == 'Sinistres' ){
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

            $entities = $data['entities'];

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
            
            $entities = $data['entities'];

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

            $entities = $data['entities'];

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

            $entities = $data['entities'];

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

            $entities = $data['entities'];

            $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['type', 'name_marque', 'name_modele', 'immat', 'old_immat', 'pmc', 'atp', 'numero_contratV', 'reference'])
                ->get();

            $champsFinal = DB::table('champsUpdate')
                    ->select('new_name', 'old_name', 'table_name')
                    ->whereIn('old_name', $colonnes)
                    ->get(); 

        }elseif ($page == 'Sinistres' && $pageSmall == 'Véhicules') {
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'date_cloture', 'ville_sinistre', 'ref', 'name_marque', 'immat','id'];

            $entities = $data['entities'];

            $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'ville_sinistre', 'ref', 'name_marque', 'immat', 'reference', 'responsabilite', 'observation', 'reglement_macif', 'franchise', 'solde_ad', 'date_cloture'])
                ->get();

            $champsFinal = DB::table('champsUpdate')
                    ->select('new_name', 'old_name', 'table_name')
                    ->whereIn('old_name', $colonnes)
                    ->get(); 

        }elseif ($page == 'Sinistres' && $pageSmall == 'Masse') {
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'date_cloture', 'ville_sinistre', 'ref', 'num_contrat', 'intercalaire','id'];

            $entities = $data['entities'];

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

        $page = $p;
        $pageSmall = $ps;
        $routeName = $data['routeName'];
        //$uri = URL::route($routeName, [$page, $pageSmall], false);

        $villeLocal = $request->ville_local;
        $villeAlgeco = $request->ville_algeco;

        $structureID = $request->type_structure;
            //Je recherche la structure via le type de structure recup en POST
            $structure = Structure::find($structureID);
            //$structure = Structure::where('id', $typeStructure)->get();
        $numAd = $request->numero_ad;
            //Je recherche l'Ad via le numero ad récupérer en méthode POST
            $ad = Ad::where('numero_ad', $numAd)->first();

        $immat = $request->immat;
            
        if($request->has('ville_local') && $request->has('type_structure') && $request->has('numero_ad')){

            $entities = $structure->locaux->where('ad_id', $ad->id)->where('ville_local', $villeLocal)->toArray();

            if (!empty($entities)) {
                $entities = $structure->locaux->where('ad_id', $ad->id)->where('ville_local', $villeLocal);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'existe pas de local pour cette recherche');
            }
          
        }else if ($request->has('ville_local') && $request->has('type_structure')){
           
            $entities = $structure->locaux->where('ville_local', $villeLocal)->toArray();

            if (!empty($entities)) {
                $entities = $structure->locaux->where('ville_local', $villeLocal);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'existe pas de local pour cette recherche');
            }
       
        }else if ($request->has('ville_local') && $request->has('numero_ad')){

            !empty($data['entities']) ? $entities = $data['entities']
                    ->where('ad_id', $ad->id)
                    ->where('ville_local', $villeLocal)
                    ->where('ville_algeco', $villeAlgeco)
                    ->toArray() : [];

            if (!empty($entities)) {
                $entities = $data['entities']
                    ->where('ad_id', $ad->id)
                    ->where('ville_local', $villeLocal)
                    ->where('ville_algeco', $villeAlgeco);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'existe pas de local pour cette recherche');
            }

        }else if ($request->has('type_structure') && $request->has('numero_ad')){
            
            $entities = $structure->locaux->where('ad_id', $ad->id)->toArray();

            if (!empty($entities)) {
                $entities = $structure->locaux->where('ad_id', $ad->id);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'existe pas de local pour cette recherche');
            }

        }else if ($request->has('ville_local') || $request->has('ville_algeco')){

            !empty($data['entities']) ? $entities = $data['entities']->where('ville_local', $villeLocal)->where('ville_algeco', $villeAlgeco)->toArray() : [];

            if (!empty($entities)) {
                
                $entities = $data['entities']->where('ville_local', $villeLocal)->where('ville_algeco', $villeAlgeco);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('La ville recherchée ne possède aucun local pour ce contrat');
            }

        }else if ($request->has('type_structure')){

            $structures = $data['structures'];

            $entities = $structure->locaux->toArray();
          
            if (!empty($entities)) {
                $entities = $structure->locaux;
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'a pas de locaux avec ce type de structure');
            }

        }else if ($request->has('numero_ad')){
            
            if ($page == 'Sinistres' && $pageSmall == 'Véhicules') {
            
                $sinistres = Sinistre::join('vehicules', 'vehicules.contrat_v_id', '=', 'sinistres.contrat_v_id' )
                            ->where('ad_id', $ad->id)
                            ->get();

                $entities = $sinistres->toArray();
            
                if (!empty($entities)) {
                    $entities = $sinistres;
                }else{

                    return redirect()
                            ->route($routeName, [$page, $pageSmall])
                            ->withErrors('L\'AD recherchée ne possède pas de sinistre');
                }
            }else{

                !empty($data['entities']) ? $entities = $data['entities']->where('ad_id', $ad->id)->toArray() : [];
            
                if (!empty($entities)) {
                    $entities = $data['entities']->where('ad_id', $ad->id);
                }else{

                    return redirect()
                            ->route($routeName, [$page, $pageSmall])
                            ->withErrors('L\'AD recherchée ne possède aucun local pour ce contrat');
                }
            }
               
        }else if($request->has('immat')){

            if ($page == 'Sinistres' && $pageSmall == 'Véhicules') {
            
                $sinistres = Sinistre::join('vehicules', 'vehicules.contrat_v_id', '=', 'sinistres.contrat_v_id' )
                            ->where('immat', $immat)
                            ->get();

                $entities = $sinistres->toArray();
            
                if (!empty($entities)) {
                    $entities = $sinistres;
                }else{

                    return redirect()
                            ->route($routeName, [$page, $pageSmall])
                            ->withErrors('Il n\'y a pas de sinistre pour ce n° d\'immat.');
                }

            }else{
                !empty($data['entities']) ? $entities = $data['entities']->where('immat', $immat)->toArray() : [];

                if (!empty($entities)) {
                    
                    $entities = $data['entities']->where('immat', $immat);
                }else{

                    return redirect()
                            ->route($routeName, [$page, $pageSmall])
                            ->withErrors('Il n\' exsite pas de véhicule pour ce numéro d\'immatriculation');
                }
            }

        }else{
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

        }elseif ($page == 'Sinistres' && $pageSmall = 'Véhicules') {
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'date_cloture', 'ville_sinistre', 'ref', 'name_marque', 'immat','id'];

            $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['ref_macif', 'ref_rdc', 'date_reception', 'date_ouverture', 'date_sinistre', 'ville_sinistre', 'ref', 'name_marque', 'immat', 'reference', 'responsabilite', 'observation', 'reglement_macif', 'franchise', 'solde_ad', 'date_cloture'])
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

}
