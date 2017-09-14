<?php

namespace App\Http\Controllers\Admin;

use DB;
use URL;
use Route;
use App\Models\Evenement;
use Jenssegers\Date\Date;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EvenementsRequest;

class EvenementsController extends Controller
{
    public function dataEvenement(){

        $entities = Evenement::all();

        $page = 'Evenements';
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
        $data = (new EvenementsController)->dataEvenement();

        $request->session()->forget('columns');
        $request->session()->forget('champsFinal');
        $request->session()->forget('entities');

        $routeName = Route::currentRouteName();

        $page = $data['page'];
        $pageSmall = $data['pageSmall'];

        $colonnes = ['nom_salle', 'adresse_event', 'cp_event','ville_event', 'nom_event', 'duree_event', 'type_event', 'statut_event' ,'date_demande', 'date_reponse', 'remarque'];

        $entities = $data['entities'];
        //dump($entities); die; 
        
        DB::table('champsUpdate')
            ->whereIn('old_name', $colonnes)
            ->update(['status' => 1]);

        DB::table('champsUpdate')
            ->whereNotIn('old_name', $colonnes)
            ->update(['status' => 0]);

        $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['nom_salle', 'adresse_event', 'cp_event','ville_event', 'nom_event', 'duree_event', 'type_event', 'statut_event' ,'date_demande', 'date_reponse', 'remarque'])
                ->get();

        $champsFinal = DB::table('champsUpdate')
                    ->select('new_name', 'old_name', 'table_name')
                    ->whereIn('old_name', $colonnes)
                    ->get();

        $request->session()->put('champsFinal', $champsFinal);

        return view('admin.blocs.entities', compact('page', 'pageSmall', 'entities', 'champs', 'champsFinal', 'colonnes', 'routeName'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($p, $ps, $id)
    {
        $data = (new EvenementsController)->dataEvenement();

        $page = $data['page'];
        $pageSmall = $data['pageSmall'];

        $evenement = Evenement::findOrFail($id);

        return view('admin.blocs.evenements-edit-create', compact('page', 'pageSmall', 'evenement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EvenementsRequest $request, $p, $ps, $id)
    {	
        $page = $p;
        $pageSmall = $ps;

        $evenement = Evenement::findOrFail($id);

        //update de l'event
        if ((strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE)) {
            
            $dateDemande = date('Y-d-m', strtotime($request->date_demande));
            $dateReponse = date('Y-d-m', strtotime($request->date_reponse));

        }else{
            $dateDemande = $request->date_demande;
            $dateReponse = $request->date_reponse;
        }

        $updateEvenement= [
            'nom_salle' => $request->nom_salle,
            'adresse_event' => $request->adresse_event,
            'cp_event' => $request->cp_event,
            'ville_event' => $request->ville_event,
            'nom_event' => $request->nom_event,
            'type_event' => $request->type_event,
            'duree_event' => $request->duree_event,
            'statut_event' => $request->statut_event,
            'date_demande' => $dateDemande,
            'date_reponse' => $dateReponse,
            'remarque' => $request->remarque
        ];
        $evenement->update( $updateEvenement );

        return redirect()
                ->route('listeEvenements.index', [$page, $pageSmall])
                ->withSuccess('L\'évènement a bien été modifié.');
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

        $evenement = Evenement::destroy($id);
 
        return redirect()
                ->route('listeEvenements.index', [$page, $pageSmall])
                ->withSuccess('L\'évènement a bien été supprimé.');
    }
}
