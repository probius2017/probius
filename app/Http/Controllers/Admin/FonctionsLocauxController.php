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
use App\Models\Structure;
use App\Http\Requests;
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
        
        $routePage = Route::current()->parameters();

       if ($routeName == 'rechercheVille') {
            
            $locauxVille = Local::select('ville_local')
                        ->whereRaw('LOWER(ville_local) like ?', '%'.$term.'%');

            $searches = Algeco::select('ville_algeco as ville')
                        ->whereRaw('LOWER(ville_algeco) like ?', '%'.$term.'%')
                        ->union($locauxVille)
                        ->take(6)
                        ->get();

            foreach ($searches as $search) {
              $results[] = $search->ville;
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

            $locaux = Local::all();
            $structures = Structure::all();
            $routeName = 'listeLocaux.index';

        }else if($routePage['page'] == 'ACI' && $routePage['info'] == '>50RI'){
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'intercalaire', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];

            $structures = Structure::where('RI', '>=50')->get();
            $contrats = Contrat::where('num_contrat', '9322933')->get();
            
            foreach ($contrats as $contrat) {

                $contratLocauxID[] = $contrat->local_id;
            }
            isset($contratLocauxID) ? $locaux = Local::whereIn('id', $contratLocauxID)->get() : $locaux = [];
            $routeName = 'listeACI.index';

        }else if($routePage['page'] == 'ACI' && $routePage['info'] == 'RCPRO'){
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'intercalaire', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];

            $structures = Structure::whereIn('type_structure', ['ACI (<=25)', 'ACI (>=50)', 'ACI (jardin - <=25)', 'ACI (jardin - >=50)'] )->get();

            $contrats = Contrat::where('num_contrat', '971 0000 94067 F 50')->get();

            foreach ($contrats as $contrat) {

                $contratLocauxID[] = $contrat->local_id;
            }

            isset($contratLocauxID) ? $locaux = Local::whereIn('id', $contratLocauxID)->get() : $locaux = [];
            $routeName = 'listeAciRCPRO.index';

        }elseif ($routePage['page'] == 'Entrepots') {

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'intercalaire', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];

            $structures = Structure::where('type_structure', 'Entrepot (>25)')->get();
            $contrats = Contrat::where('num_contrat', '9453148')->get();
            
            foreach ($contrats as $contrat) {

                $contratLocauxID[] = $contrat->local_id;
            }

            isset($contratLocauxID) ? $locaux = Local::whereIn('id', $contratLocauxID)->get() : $locaux = [];
            $routeName = 'listeEntrepots.index';

        }elseif ($routePage['page'] == 'AN') {

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'intercalaire', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];

            $structures = Structure::where('type_structure', 'Bien AN')->get();
            $contrats = Contrat::where('num_contrat', '6665737')->get();
        
            foreach ($contrats as $contrat) {

                $contratLocauxID[] = $contrat->local_id;
            }

            isset($contratLocauxID) ? $locaux = Local::whereIn('id', $contratLocauxID)->get() : $locaux = [];
            $routeName = 'listeBiensAN.index';

        }elseif ($routePage['page'] == 'Chambres-froides') {

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'cp_local', 'ville_local', 'adresse_local', 'id'];

            $structures = [];
            $contrats = Contrat::where('num_contrat', '9453062')->get();
        
            foreach ($contrats as $contrat) {

                $contratLocauxID[] = $contrat->local_id;
            }

            isset($contratLocauxID) ? $locaux = Local::whereIn('id', $contratLocauxID)->get() : $locaux = [];
            $routeName = 'listeChambresFroides.index';

        }elseif ($routePage['page'] == 'Algecos') {

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['ad_id', 'intercalaire', 'cp_algeco', 'ville_algeco', 'adresse_algeco', 'type_algeco', 'id', 'bail_id'];

            $structures = [];
            $contrats = Contrat::where('num_contrat', '9453755')->get();
        
            foreach ($contrats as $contrat) {

                $contratAlgecosID[] = $contrat->algeco_id;
            }

            isset($contratAlgecosID) ? $locaux = Algeco::whereIn('id', $contratAlgecosID)->get() : $locaux = [];
            $routeName = 'listeAlgecos.index';
        }

        $array = ['locaux' => $locaux, 'structures' => $structures, 'routeName' => $routeName, 'colonnes' => $colonnes];

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
            }else{

                $colonnes = ['ad_id', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'id', 'bail_id'];
            }
        }
        else{

            $colonnes = $request->columns;

            if($page == 'Chambres-froides'){
                array_push($colonnes, 'id');
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

            $locaux = $data['locaux'];

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
            
            $locaux = $data['locaux'];

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

            $locaux = $data['locaux'];

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

            $locaux = $data['locaux'];

            $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['cp_algeco', 'ville_algeco', 'adresse_algeco', 'type_algeco', 'num_contrat', 'intercalaire', 'complementGeographique', 'apptEscalier'])
                ->get();

            $champsFinal = DB::table('champsUpdate')
                    ->select('new_name', 'old_name', 'table_name')
                    ->whereIn('old_name', $colonnes)
                    ->get(); 
        }

        $request->session()->put('champsFinal', $champsFinal);

        return view('admin.blocs.locaux', compact('page', 'pageSmall', 'locaux', 'structures', 'champs', 'champsFinal', 'colonnes', 'routeName'));
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
            
        if($request->has('ville_local') && $request->has('type_structure') && $request->has('numero_ad')){

            $locaux = $structure->locaux->where('ad_id', $ad->id)->where('ville_local', $villeLocal)->toArray();

            if (!empty($locaux)) {
                $locaux = $structure->locaux->where('ad_id', $ad->id)->where('ville_local', $villeLocal);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'existe pas de local pour cette recherche');
            }
          
        }else if ($request->has('ville_local') && $request->has('type_structure')){
           
            $locaux = $structure->locaux->where('ville_local', $villeLocal)->toArray();

            if (!empty($locaux)) {
                $locaux = $structure->locaux->where('ville_local', $villeLocal);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'existe pas de local pour cette recherche');
            }
       
        }else if ($request->has('ville_local') && $request->has('numero_ad')){

            !empty($data['locaux']) ? $locaux = $data['locaux']
                    ->where('ad_id', $ad->id)
                    ->where('ville_local', $villeLocal)
                    ->where('ville_algeco', $villeAlgeco)
                    ->toArray() : [];

            if (!empty($locaux)) {
                $locaux = $data['locaux']
                    ->where('ad_id', $ad->id)
                    ->where('ville_local', $villeLocal)
                    ->where('ville_algeco', $villeAlgeco);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'existe pas de local pour cette recherche');
            }

        }else if ($request->has('type_structure') && $request->has('numero_ad')){
            
            $locaux = $structure->locaux->where('ad_id', $ad->id)->toArray();

            if (!empty($locaux)) {
                $locaux = $structure->locaux->where('ad_id', $ad->id);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'existe pas de local pour cette recherche');
            }

        }else if ($request->has('ville_local') || $request->has('ville_algeco')){

            !empty($data['locaux']) ? $locaux = $data['locaux']->where('ville_local', $villeLocal)->where('ville_algeco', $villeAlgeco)->toArray() : [];

            if (!empty($locaux)) {
                
                $locaux = $data['locaux']->where('ville_local', $villeLocal)->where('ville_algeco', $villeAlgeco);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('La ville recherchée ne possède aucun local pour ce contrat');
            }

        }else if ($request->has('type_structure')){

            $structures = $data['structures'];

            $locaux = $structure->locaux->toArray();
          
            if (!empty($locaux)) {
                $locaux = $structure->locaux;
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'a pas de locaux avec ce type de structure');
            }

        }else if ($request->has('numero_ad')){
            
            //Je récupère tout les locaux appartenant à cette AD et en fonction du type de contrat
            !empty($data['locaux']) ? $locaux = $data['locaux']->where('ad_id', $ad->id)->toArray() : [];
            
            if (!empty($locaux)) {
                $locaux = $data['locaux']->where('ad_id', $ad->id);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('L\'AD recherchée ne possède aucun local pour ce contrat');
            }
                
        }else{
            $locaux = $data['locaux'];
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
        }
    
        $champsFinal = DB::table('champsUpdate')
                    ->select('new_name', 'old_name', 'table_name')
                    ->whereIn('old_name', $colonnes)
                    ->get(); 

        return view('admin.blocs.locaux', compact('page', 'pageSmall', 'locaux', 'structures', 'champs', 'champsFinal', 'colonnes', 'routeName'));
    }
}
