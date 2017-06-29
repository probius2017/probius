<?php

namespace App\Http\Controllers\Admin;

use DB;
use Excel;
use App\Models\Local;
use App\Models\NewChamp;
use Illuminate\Http\Request;
use App\Http\Requests\LocauxRequest;
use App\Http\Controllers\Controller;


class importExportController extends Controller
{

    public function downloadExcel(Request $request, $type){

    	$colonnes = $request->columns;

        $champs = DB::table('champsUpdate')
                ->select('new_name', 'old_name')
                ->whereIn('old_name', $colonnes)
                ->get();

        $count = $champs->count();

    	$data = Local::LocauxStructures()
    		->select($colonnes)
    		->where('RI', '<=25')
    		->get();

		$excelExport = Excel::create('locaux(<25RI)', function($excel) use ($data, $champs){

			$excel->setTitle('Liste des locaux <25RI');

			$excel->sheet('locaux', function($sheet) use ($data, $champs)
	        {	

	        	$sheet->loadView('admin.blocs.excelView')
	        		  ->with('data', $data)
	        		  ->with('champs', $champs)
	        		  ->setAutoFilter('A1:E1')
	        		  ->freezeFirstRowAndColumn()
	        		  ->setAutoSize(true);


				
	        });

		})->download($type);

		return $excelExport;

    }
}
