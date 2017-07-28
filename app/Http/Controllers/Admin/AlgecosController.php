<?php

namespace App\Http\Controllers\Admin;

use Route;
use URL;
use DB;
use Response;
use App\Models\Ad;
use App\Models\Local;
use App\Models\Bail;
use App\Models\Contrat;
use App\Models\Algeco;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\AlgecosRequest;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Str;

class AlgecosController extends Controller
{
    public function dataAlgeco(){

        $contrats = Contrat::where('num_contrat', '9453755')->get();
                       
        foreach ($contrats as $contrat) {

            $contratAlgecosID[] = $contrat->algeco_id;
        }

        isset($contratAlgecosID) ? $entities = Algeco::whereIn('id', $contratAlgecosID)->get() : $entities = [];

        $page = 'Algecos';
        $pageSmall = ' ';

        $array = ['entities' => $entities, 'contrats' => $contrats, 'page' => $page, 'pageSmall' => $pageSmall];

        return $array;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = (new AlgecosController)->dataAlgeco();

        $request->session()->forget('columns');
        $request->session()->forget('champsFinal');

        $routeName = Route::currentRouteName();

        $page = $data['page'];
        $pageSmall = $data['pageSmall'];

        $colonnes = ['ad_id', 'intercalaire', 'cp_algeco', 'ville_algeco', 'adresse_algeco', 'type_algeco', 'id', 'bail_id'];

        $entities = $data['entities'];

        DB::table('champsUpdate')
            ->whereIn('old_name', $colonnes)
            ->update(['status' => 1]);

        DB::table('champsUpdate')
            ->whereNotIn('old_name', $colonnes)
            ->update(['status' => 0]);

        $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['cp_algeco', 'ville_algeco', 'adresse_algeco', 'type_algeco', 'num_contrat', 'intercalaire', 'complementGeographique', 'apptEscalier'])
                ->get();

        $champsFinal = DB::table('champsUpdate')
                    ->select('new_name', 'old_name', 'table_name')
                    ->whereIn('old_name', $colonnes)
                    ->get();

        $request->session()->put('champsFinal', $champsFinal);

        return view('admin.blocs.entities', compact('page', 'pageSmall', 'entities', 'champs', 'champsFinal', 'colonnes', 'routeName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($p, $ps, $id)
    {
        $data = (new AlgecosController)->dataAlgeco();

        $page = $data['page'];
        $pageSmall = $data['pageSmall'];

        $algeco = Algeco::findOrFail($id);

        $bail = Bail::findOrFail($algeco->bail_id);

        return view('admin.blocs.algecos-edit-create', compact('page', 'pageSmall', 'algeco', 'bail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlgecosRequest $request, $p, $ps, $id)
    {
        $page = $p;
        $pageSmall = $ps;

        $algeco = Algeco::findOrFail($id);

        //update de l'algéco
        $updateAlgeco = [
            'ville_algeco' => $request->ville_algeco,
            'cp_algeco' => $request->cp_algeco,
            'adresse_algeco' => $request->adresse_algeco,
            'type_algeco' => $request->type_algeco,
            'apptEscalier' => $request->apptEscalier,
            'complementGeographique' => $request->complementGeographique,
        ];
        $algeco->update( $updateAlgeco );

        //Update pour le bail de l'algéco
        if ((strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE)) {
            
            $date_debut = date('Y-d-m', strtotime($request->date_debut));
            $date_signature = date('Y-d-m', strtotime($request->date_signature));
            $date_fin = date('Y-d-m', strtotime($request->date_fin));

        }else{
            $date_debut = $request->date_debut;
            $date_signature = $request->date_signature;
            $date_fin = $request->date_fin;
        }

        $bail = Bail::findOrFail($algeco->bail_id);

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
            'clause' => $request->clause,
            'type_document' => $request->type_document
        ];

        $bail->update( $updateBail );

        $request->clause == 0 ? $bail->clause = 'résiliation' : $bail->clause = 'résolutoire';

        $bail->save();

        return redirect()
                ->route('listeAlgecos.index', [$page, $pageSmall])
                ->withSuccess('L\'algéco a bien été modifié.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($p, $ps, $id)
    {
        $page = $p;
        $pageSmall = $ps;

        $contrats = Contrat::where('algeco_id', $id)->delete();
        $algeco = Algeco::destroy($id);

        return redirect(route('listeAlgecos.index', [$page, $pageSmall]))
                ->withSuccess('L\'algéco a bien été supprimé.');
    }
}
