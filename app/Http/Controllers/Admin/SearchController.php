<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Local;
use App\Models\Structure;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Route;
use DB;
use Response;

class SearchController extends Controller
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
}
