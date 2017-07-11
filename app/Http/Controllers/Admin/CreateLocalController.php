<?php

namespace App\Http\Controllers\Admin;

use DB;
use Carbon\Carbon;
use App\Http\Requests;
use App\Models\Local;
use App\Models\Bail;
use App\Models\Structure;
use App\Models\Contrat;
use Illuminate\Http\Request;
use App\Http\Requests\LocauxRequest;
use App\Http\Controllers\Controller;

class CreateLocalController extends Controller
{
    public function create(){

    	$page = 'createLocal';

        $local = new Local;
        $bail = new Bail;

        $contrat = new Contrat;

        $structures = Structure::distinct()->get();

        return view('admin.blocs.createLocal', compact('page', 'local', 'structures', 'bail'));
    }

    public function store(LocauxRequest $request){

    }
}
