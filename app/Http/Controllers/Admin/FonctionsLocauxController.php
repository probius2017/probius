<?php

namespace App\Http\Controllers\Admin;

use Route;
use URL;
use DB;
use Response;
use App\Models\Local;
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

        if ($routeName == 'rechercheVille') {
            $searches = Local::LocauxStructures()
                ->distinct()
                ->select('ville_local')
                ->whereRaw('LOWER(ville_local) like ?', '%'.$term.'%')
                ->orderBy('ville_local')
                ->take(6)
                ->get();

            foreach ($searches as $search) {
              $results[] = $search->ville_local;
            }

        }else{
            $searches = Local::LocauxStructures()
                        ->distinct()
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
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['numero_ad', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'local_id', 'bail_id', 'type_structure'];

            $locaux = Local::LocauxStructures()
                        ->distinct()
                        ->select($colonnes)
                        ->where('RI', '!=', null)
                        ->get();

            $structures = Structure::where('RI', '<=25')->get();
            $routeName = 'listeLocaux.index';
            $champs = DB::table('champsUpdate')->select('champsUpdate.*')->where('table_name', 'locaux')->orWhere('table_name', 'structures')->orWhere('table_name', 'baux')->get();

        }else if($routePage['page'] == 'ACI' && $routePage['info'] == '>50RI'){
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['numero_ad', 'intercalaire', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'type_structure'];
            $locaux = Local::LocauxStructures()->where('RI', '>=50')->where('num_contrat', '9322933')->get();
            $structures = Structure::where('RI', '>=50')->get();
            $routeName = 'listeACI.index';
            $champs = DB::table('champsUpdate')->select('champsUpdate.*')->where('table_name', 'locaux')->orWhere('table_name', 'structures')->orWhere('table_name', 'baux')->orWhere('table_name', 'contrats')->get();
        }

        $array = ['locaux' => $locaux, 'structures' => $structures, 'champs' => $champs, 'routeName' => $routeName, 'colonnes' => $colonnes];

        return $array;
    }

    public function updateColumns(Request $request, $p, $ps){   
        
        $data = (new FonctionsLocauxController)->dataLocaux();

        $request->session()->forget('columns');

        $page = $p;
        $pageSmall = $ps;
        $routeName = $data['routeName'];

        $colonnes = $request->columns;
            array_push($colonnes, 'local_id', 'bail_id', 'type_structure');

        $request->session()->put('columns', $colonnes);
       /* $index = array_search('ad_id', $colonnes); 
        array_splice($colonnes, $index, 1, array('test'));*/

        $structures = $data['structures'];

        DB::table('champsUpdate')
            ->whereIn('old_name', $colonnes)
            ->update(['status' => 1]);

        DB::table('champsUpdate')
            ->whereNotIn('old_name', $colonnes)
            ->update(['status' => 0]);

        if ($page == 'Locaux') {
            
            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['numero_ad', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'local_id', 'bail_id', 'type_structure'];

            $locauxStructures = Local::LocauxStructures()
                        ->distinct()
                        ->select($colonnes)
                        ->where('RI', '!=', null)
                        ->get();

            $champs = DB::table('champsUpdate')->select('champsUpdate.*')->where('table_name', 'locaux')->orWhere('table_name', 'structures')->orWhere('table_name', 'baux')->get();

        }else{  

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['numero_ad', 'intercalaire', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'type_structure'];

            $locauxStructures = $data['locaux'];

            $champs = DB::table('champsUpdate')->select('champsUpdate.*')->where('table_name', 'locaux')->orWhere('table_name', 'structures')->orWhere('table_name', 'baux')->orWhere('table_name', 'contrats')->get();
        }

        $champsFinal = DB::table('champsUpdate')
                ->select('new_name', 'old_name')
                ->whereIn('old_name', $colonnes)
                ->get();

        $request->session()->put('champsFinal', $champsFinal);

        return view('admin.blocs.locaux', compact('page', 'pageSmall', 'locauxStructures', 'structures', 'champs', 'champsFinal', 'colonnes', 'routeName'));
    }

    public function filters(Request $request, $p, $ps){   
        
        $data = (new FonctionsLocauxController)->dataLocaux();
    
        $page = $p;
        $pageSmall = $ps;
        $routeName = $data['routeName'];
        //$uri = URL::route($routeName, [$page, $pageSmall], false);

        if($request->has('ville_local') && $request->has('type_structure') && $request->has('numero_ad')){

            $locauxStructures = $data['locaux']->where('ville_local', $request->ville_local)->where('type_structure', $request->type_structure)->where('numero_ad', $request->numero_ad)->toArray();

            if (!empty($locauxStructures)) {
                
                $locauxStructures = $data['locaux']->where('ville_local', $request->ville_local)->where('type_structure', $request->type_structure)->where('numero_ad', $request->numero_ad);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'existe pas de local pour cette recherche');
            }
          

        }else if ($request->has('ville_local') && $request->has('type_structure')){

           
            $locauxStructures = $data['locaux']->where('ville_local', $request->ville_local)->where('type_structure', $request->type_structure)->toArray();

            if (!empty($locauxStructures)) {
                
                $locauxStructures = $data['locaux']->where('ville_local', $request->ville_local)->where('type_structure', $request->type_structure);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'existe pas de local pour cette recherche');
            }
       
        }else if ($request->has('ville_local') && $request->has('numero_ad')){

            $locauxStructures = $data['locaux']->where('ville_local', $request->ville_local)->where('numero_ad', $request->numero_ad)->toArray();

            if (!empty($locauxStructures)) {
                
                $locauxStructures = $data['locaux']->where('ville_local', $request->ville_local)->where('numero_ad', $request->numero_ad);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'existe pas de local pour cette recherche');
            }

        }else if ($request->has('type_structure') && $request->has('numero_ad')){

            $locauxStructures = $data['locaux']->where('type_structure', $request->type_structure)->where('numero_ad', $request->numero_ad)->toArray();

            if (!empty($locauxStructures)) {
                
                $locauxStructures = $data['locaux']->where('type_structure', $request->type_structure)->where('numero_ad', $request->numero_ad);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'existe pas de local pour cette recherche');
            }

        }else if ($request->has('ville_local')){

            $locauxStructures = $data['locaux']->where('ville_local', $request->ville_local)->toArray();

            if (!empty($locauxStructures)) {
                
                $locauxStructures = $data['locaux']->where('ville_local', $request->ville_local);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('La ville recherchée ne possède aucun local pour ce contrat');
            }

        }else if ($request->has('type_structure')){

            //dump($request->type_structure); die; 

            $locauxStructures = $data['locaux']->where('type_structure', $request->type_structure)->toArray();

            if (!empty($locauxStructures)) {
                
                $locauxStructures = $data['locaux']->where('type_structure', $request->type_structure);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('Il n\'a pas de locaux avec ce type de structure');
            }

        }else if ($request->has('numero_ad')){

            $locauxStructures = $data['locaux']->where('numero_ad', $request->numero_ad)->toArray();

            if (!empty($locauxStructures)) {
                
                $locauxStructures = $data['locaux']->where('numero_ad', $request->numero_ad);
            }else{

                return redirect()
                        ->route($routeName, [$page, $pageSmall])
                        ->withErrors('L\'AD recherchée ne possède aucun local pour ce contrat');
            }
                
        }else{
            $locauxStructures = $data['locaux'];
        }

        $structures = $data['structures'];
        $champs = $data['champs'];
        $colonnes = $data['colonnes'];
        /*if ($page == 'Locaux') {

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['numero_ad', 'cp_local', 'ville_local', 'adresse_local', 'superficie', 'local_id', 'bail_id'];
        }else{  

            session('columns') != null ? $colonnes = session('columns') : $colonnes = ['numero_ad', 'intercalaire', 'cp_local', 'ville_local', 'adresse_local', 'superficie'];
        }*/

        $champsFinal = DB::table('champsUpdate')
                ->select('new_name', 'old_name')
                ->whereIn('old_name', $colonnes)
                ->get();

        return view('admin.blocs.locaux', compact('page', 'pageSmall', 'locauxStructures', 'structures', 'champsFinal', 'champs', 'colonnes', 'routeName'));
    }
}
