<?php

namespace App\Http\Controllers\Admin;

use DB;
use Excel;
use App\Models\Local;
use App\Models\Bail;
use App\Models\Algeco;
use App\Models\Vehicule;
use App\Models\Contrat;
use App\Models\Sinistre;
use App\Models\Evenement;
use App\Models\ChambreFroide;
use App\Models\NewChamp;
use App\Models\HistoriqueLocal;
use App\Models\HistoriqueVehicule;
use Jenssegers\Date\Date;
use Illuminate\Http\Request;
use App\Http\Requests\LocauxRequest;
use App\Http\Controllers\Controller;


class importExportController extends Controller
{

    public function downloadExcel(Request $request, $p, $ps, $type){

        $colonnes = $request->columns;
        $entitiesIDs = $request->entitiesID;
        $tabtest = [];

        $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name')
                ->whereIn('old_name', $colonnes)
                ->get();

        //On recherche si les champs de la table contrats sont présents, si oui on les places dans un new aray et on supprime dans l'autre
        /*if (in_array('num_contrat', $colonnes)) {
            $key1 = array_search('num_contrat', $colonnes);
            array_push($tabtest, $colonnes[$key1]);
            array_splice($colonnes, $key1, 1);
        }
        if (in_array('intercalaire', $colonnes)) {
            $key2 = array_search('num_contrat', $colonnes);
            array_push($tabtest, $colonnes[$key2]);
            array_splice($colonnes, $key2, 1);
        }*/
 
        if ($p == 'Locaux') {
            
            array_push($colonnes, 'ad_id');
            $query = Local::join('baux', 'locaux.bail_id', '=', 'baux.id')
                        ->select($colonnes);

            $data = $query->addSelect('locaux.id')
                        ->whereIn('locaux.id', $entitiesIDs)
                        ->orderBy('locaux.id')
                        ->get();

        }elseif ($p == 'ACI' && $ps == '>50RI') {
            
            array_push($colonnes, 'ad_id');
            $query = Local::join('baux', 'locaux.bail_id', '=', 'baux.id')
                        ->join('contrats', function($join){
                            $join->on('locaux.id', '=', 'contrats.local_id')
                                 ->where('contrats.type_contrat', 2);
                        })
                        ->select($colonnes);

            $data = $query->addSelect('locaux.id')
                        ->whereIn('locaux.id', $entitiesIDs)
                        ->orderBy('locaux.id')
                        ->get();

        }elseif ($p == 'ACI' && $ps == 'RCPRO') {
            
            array_push($colonnes, 'ad_id');
            $query = Local::join('baux', 'locaux.bail_id', '=', 'baux.id')
                        ->join('contrats', function($join){
                            $join->on('locaux.id', '=', 'contrats.local_id')
                                 ->where('contrats.type_contrat', 1);
                        })
                        ->select($colonnes);

            $data = $query->addSelect('locaux.id')
                        ->whereIn('locaux.id', $entitiesIDs)
                        ->orderBy('locaux.id')
                        ->get();

        }elseif ($p == 'Entrepots') {
            
            array_push($colonnes, 'ad_id');
            $query = Local::join('baux', 'locaux.bail_id', '=', 'baux.id')
                        ->join('contrats', function($join){
                            $join->on('locaux.id', '=', 'contrats.local_id')
                                 ->where('contrats.type_contrat', 3);
                        })
                        ->select($colonnes);

            $data = $query->addSelect('locaux.id')
                        ->whereIn('locaux.id', $entitiesIDs)
                        ->orderBy('locaux.id')
                        ->get();

        }elseif ($p == 'AN') {
            
            array_push($colonnes, 'ad_id');
            $query = Local::join('baux', 'locaux.bail_id', '=', 'baux.id')
                        ->join('contrats', function($join){
                            $join->on('locaux.id', '=', 'contrats.local_id')
                                 ->where('contrats.type_contrat', 4);
                        })
                        ->select($colonnes);

            $data = $query->addSelect('locaux.id')
                        ->whereIn('locaux.id', $entitiesIDs)
                        ->orderBy('locaux.id')
                        ->get();

        }elseif ($p == 'Chambres-froides') {
            
            array_push($colonnes, 'ad_id');
            $query = Local::join('contrats', 'locaux.id', '=', 'contrats.local_id')
                        ->where('contrats.type_contrat', 5)
                        ->select($colonnes);

            $data = $query->addSelect('locaux.id')
                        ->whereIn('locaux.id', $entitiesIDs)
                        ->orderBy('locaux.id')
                        ->get();

        }elseif ($p == 'Algecos') {
            
            array_push($colonnes, 'ad_id');
            $query = Algeco::join('contrats', 'algecos.id', '=', 'contrats.algeco_id')
                        ->where('contrats.type_contrat', 6)
                        ->select($colonnes);

            $data = $query->addSelect('algecos.id')
                        ->whereIn('algecos.id', $entitiesIDs)
                        ->orderBy('algecos.id')
                        ->get();

        }elseif ($p == 'Vehicules') {
            array_push($colonnes, 'ad_id');
            $query = Vehicule::join('contrat_v', 'contrat_v.id', '=', 'vehicules.contrat_v_id')
                    ->join('marques', function($join){
                        $join->on('marques.id', '=', 'vehicules.marque_id');
                    })
                    ->join('modeles', function($join){
                        $join->on('modeles.id', '=', 'vehicules.modele_id');
                    })
                    ->join('garanties', function($join){
                        $join->on('garanties.id', '=', 'contrat_v.garantie_id');
                    })
                    ->join('categories', function($join){
                        $join->on('categories.id', '=', 'modeles.category_id');
                    })
                    ->select($colonnes);

            $data = $query->addSelect('vehicules.id')
                    ->whereIn('vehicules.id', $entitiesIDs)
                    ->orderBy('vehicules.id')
                    ->get();

        }elseif ($p == 'Evenements') {
            array_push($colonnes, 'id');
            $data = Evenement::select($colonnes)->whereIn('id', $entitiesIDs)->get();

        }elseif ($p == 'Sinistres') {
            
            if ($ps == 'Mas') {
                array_push($colonnes, 'contrat_id', 'local_id', 'algeco_id');
                $query = Sinistre::join('type_sinistre', 'type_sinistre.id', '=', 'sinistres.type_sinistre_id')
                        ->join('contrats', function($join){
                            $join->on('contrats.id', '=', 'sinistres.contrat_id');
                        })
                        ->whereNotNull('contrat_id')
                        ->select($colonnes);

                $data = $query->addSelect('sinistres.id')
                        ->whereIn('sinistres.id', $entitiesIDs)
                        ->orderBy('sinistres.ref_rdc')
                        ->get();
            }else{
                array_push($colonnes, 'contrat_v.id as contrat_v_id');
                $query = Sinistre::join('type_sinistre', 'type_sinistre.id', '=', 'sinistres.type_sinistre_id')

                        ->join('contrat_v', function($join){
                            $join->on('contrat_v.id', '=', 'sinistres.contrat_v_id')
                            ->whereNotNull('contrat_v_id');
                        })
                        ->join('vehicules', function($join){
                            $join->on('contrat_v.id', '=', 'vehicules.contrat_v_id');
                        })
                        ->join('garanties', function($join){
                            $join->on('garanties.id', '=', 'contrat_v.garantie_id');
                        })
                        ->join('marques', function($join){
                            $join->on('marques.id', '=', 'vehicules.marque_id');
                        })
                        ->select($colonnes);
              
                $data = $query->addSelect('sinistres.id')
                        ->whereIn('sinistres.id', $entitiesIDs)
                        ->orderBy('sinistres.ref_rdc')
                        ->get();
            }
            
        }elseif ($p == 'Historique') {
            
            if ($ps == 'Locaux') {
                $data = HistoriqueLocal::all();
                $colonnes = ['ville_local', 'cp_local', 'adresse_local', 'apptEscalier', 'complementGeographique', 'superficie'];
            }else{
                $data = HistoriqueVehicule::all();
                $colonnes = ['name_marque', 'name_modele', 'immat'];
            }

            $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name')
                ->whereIn('old_name', $colonnes)
                ->get();

        }elseif ($p == 'Logements') {
            array_push($colonnes, 'id');
            $data = Logement::select($colonnes)->whereIn('id', $entitiesIDs)->get();
        }

        //dump($champs);  die;

		$excelExport = Excel::create($p.$ps, function($excel) use ($p, $ps, $data, $champs){

			$excel->setTitle('Liste des '.$p.' '.$ps);

			$excel->sheet($p, function($sheet) use ($p, $ps, $data, $champs)
	        {	
	        	$sheet->loadView('admin.blocs.excelView')
                      ->with('page', $p)
                      ->with('pageSmall', $ps)
	        		  ->with('data', $data)
	        		  ->with('champs', $champs)
	        		  ->freezeFirstRowAndColumn()
	        		  ->setAutoSize(true);
	        });

		})->download($type);

		return $excelExport;

    }
}
