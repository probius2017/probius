<?php

namespace App\Http\Controllers\Admin;

use DB;
use Route;
use Carbon\Carbon;
use App\Http\Requests;
use App\Models\Local;
use App\Models\Bail;
use App\Models\Contrat;
//use App\Models\Structure;
use Illuminate\Http\Request;
use App\Models\ChambreFroide;
use App\Http\Requests\LocauxRequest;
use App\Http\Controllers\Controller;

class ChambreFController extends Controller
{
    public function dataChambreF(){

        $contrats = Contrat::where('num_contrat', '9453062')->get();
                       
        foreach ($contrats as $contrat) {

            $contratLocauxID[] = $contrat->local_id;
        }

        isset($contratLocauxID) ? $entities = Local::whereIn('id', $contratLocauxID)->get() : $entities = [];

        $page = 'Chambres-froides';
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
        $data = (new ChambreFController)->dataChambreF();

        $request->session()->forget('columns');
        $request->session()->forget('champsFinal');
        $request->session()->forget('entities');

        $routeName = Route::currentRouteName();

        $page = $data['page'];
        $pageSmall = $data['pageSmall'];

        $colonnes = ['ad_id', 'cp_local', 'ville_local', 'adresse_local', 'id'];

        $entities = $data['entities'];

        DB::table('champsUpdate')
            ->whereIn('old_name', $colonnes)
            ->update(['status' => 1]);

        DB::table('champsUpdate')
            ->whereNotIn('old_name', $colonnes)
            ->update(['status' => 0]);

        $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name', 'status')
                ->whereIn('old_name', ['cp_local', 'ville_local', 'adresse_local', 'num_contrat'])
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $p, $ps, $id)
    {
        $page = $p;
        $pageSmall = $ps;

        $chambreF = ChambreFroide::findOrFail($id);
            //$chambreF->update($request->all());
        $chambreF->volume = $request->volume;
        $chambreF->save();

        return redirect()
                ->route('listeChambresFroides.index', [$page, $pageSmall])
                ->withSuccess('La chambre froide a bien été modifiée.');
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

        $chambreF = ChambreFroide::find($id);
        $local = $chambreF->local;
        //$local = Local::find($chambreF->local_id);
        $chambreF = ChambreFroide::destroy($id);
        
        $nbCF = $local->chambresFroides->count();

        if($nbCF == 0){
            $contratCF = $local->contrats->where('num_contrat', '9453062')->first();
            $contratFlotte = Contrat::find($contratCF->id);
            $contratFlotte->delete();
        } 

        return redirect(route('listeChambresFroides.index', [$page, $pageSmall]))
                ->withSuccess('La chambre froide a bien été supprimé.');
    }
}
