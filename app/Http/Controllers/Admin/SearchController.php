<?php

namespace App\Http\Controllers\Admin;

use Route;
use DB;
use Response;
use App\Models\Local;
use App\Models\Structure;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;


class SearchController extends Controller
{
    Protected $page, $local, $structures;

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

    public function dataFilters(){
 
        $local = Local::LocauxStructures()->where('RI', '<=25')->get();

        $structures = Structure::where('RI', '<=25')->get();

        $champs = DB::table('champsUpdate')->select('champsUpdate.*')->where('table_name', 'locaux')->orWhere('table_name', 'structures')->orWhere('table_name', 'baux')->get();

        $array = ['local' => $local, 'structures' => $structures, 'champs' => $champs];

        return $array;
    }

    public function filters(Request $request)
    {   
        $page = 'locauxInf25';
        $data = (new SearchController)->dataFilters();

        if($request->has('ville_local') && $request->has('structure_id') && $request->has('numero_ad')){

            if (is_numeric($request->structure_id)) { 

                $locauxStructures = $data['local']->where('ville_local', $request->ville_local)->where('structure_id', $request->structure_id)->where('numero_ad', $request->numero_ad)->toArray();

                if (!empty($locauxStructures)) {
                    
                    $locauxStructures = $data['local']->where('ville_local', $request->ville_local)->where('structure_id', $request->structure_id)->where('numero_ad', $request->numero_ad);
                }else{

                    return back()
                            ->withErrors('Il n\'existe pas de local pour cette recherche');
                }
            }else{
                return redirect()
                ->intended('admin/locauxInf25RI')
                ->withErrors('Veuillez rechercher une structure valide');
            }

        }else if ($request->has('ville_local') && $request->has('structure_id')){

            if (is_numeric($request->structure_id)) {

                $locauxStructures = $data['local']->where('ville_local', $request->ville_local)->where('structure_id', $request->structure_id)->toArray();

                if (!empty($locauxStructures)) {
                    
                    $locauxStructures = $data['local']->where('ville_local', $request->ville_local)->where('structure_id', $request->structure_id);
                }else{

                    return back()
                            ->withErrors('Il n\'existe pas de local pour cette recherche');
                }
            }else{
                return redirect()
                ->intended('admin/locauxInf25RI')
                ->withErrors('Veuillez rechercher une structure valide');
            }

        }else if ($request->has('ville_local') && $request->has('numero_ad')){

            //if (is_numeric($request->numero_ad)) {

                $locauxStructures = $data['local']->where('ville_local', $request->ville_local)->where('numero_ad', $request->numero_ad)->toArray();

                if (!empty($locauxStructures)) {
                    
                    $locauxStructures = $data['local']->where('ville_local', $request->ville_local)->where('numero_ad', $request->numero_ad);
                }else{

                    return back()
                            ->withErrors('Il n\'existe pas de local pour cette recherche');
                }
            //}

            /*return redirect()
                ->intended('admin/locauxInf25RI')
                ->withErrors('Veuillez rechercher une structure valide');*/

        }else if ($request->has('structure_id') && $request->has('numero_ad')){

            if (is_numeric($request->structure_id)) {

                $locauxStructures = $data['local']->where('structure_id', $request->structure_id)->where('numero_ad', $request->numero_ad)->toArray();

                if (!empty($locauxStructures)) {
                    
                    $locauxStructures = $data['local']->where('structure_id', $request->structure_id)->where('numero_ad', $request->numero_ad);
                }else{

                    return back()
                            ->withErrors('Il n\'existe pas de local pour cette recherche');
                }
            }else{
                return redirect()
                ->intended('admin/locauxInf25RI')
                ->withErrors('Veuillez rechercher une structure valide');
            }

        }else if ($request->has('ville_local')){

            $locauxStructures = $data['local']->where('ville_local', $request->ville_local)->toArray();

            if (!empty($locauxStructures)) {
                
                $locauxStructures = $data['local']->where('ville_local', $request->ville_local);
            }else{

                return back()
                        ->withErrors('La ville recherchée ne possède aucun local pour ce contrat');
            }
        }else if ($request->has('structure_id')){

            if (is_numeric($request->structure_id)) {

                $locauxStructures = $data['local']->where('structure_id', $request->structure_id)->toArray();

                if (!empty($locauxStructures)) {
                    
                    $locauxStructures = $data['local']->where('structure_id', $request->structure_id);
                }else{

                    return back()
                        ->withErrors('Il n\'a pas de locaux avec ce type de structure');
                }
            }else{
                return redirect()
                ->intended('admin/locauxInf25RI')
                ->withErrors('Veuillez rechercher une structure valide');
            }

        }else if ($request->has('numero_ad')){

            $locauxStructures = $data['local']->where('numero_ad', $request->numero_ad)->toArray();

            if (!empty($locauxStructures)) {
                
                $locauxStructures = $data['local']->where('numero_ad', $request->numero_ad);
            }else{

                return back()
                    ->withErrors('L\'AD recherchée ne possède aucun local pour ce contrat');
            }
                
        }else{
            $locauxStructures = $data['local'];
        }

        $structures = $data['structures'];
        $champs = $data['champs'];

        session('columns') != null ? $colonnes = session('columns') : $colonnes = ['numero_ad', 'cp_local', 'ville_local', 'adresse_local', 'superficie'];
            ;

        $champsFinal = DB::table('champsUpdate')
                ->select('new_name', 'old_name')
                ->whereIn('old_name', $colonnes)
                ->get();


        return view('admin.blocs.locauxInf25', compact('page', 'locauxStructures', 'structures', 'champsFinal', 'champs', 'colonnes'));
        
    }
}
