@extends('layouts.admin')

@section('title', 'historiques')

@section('content')

<h1 class="page-header"><i class="fa fa-building"></i> {{$page}} <small>{{$pageSmall}}</small></h1>

<br>

<div class="row">
    <div class="col-md-2 form-group">
    	<form action="{{ URL::to('admin/downloadExcel/xls') }}" method="POST">
    	{{csrf_field()}}
        	<button id="exportExcel" type="submit" class="btn btn-extia">Exporter (.xls) <span class="glyphicon glyphicon-export" aria-hidden="true"></span></button>
        </form>
    </div>
</div>

<div class="">
	<table class="table">
	    <thead >
	    	@if($page == 'Historique' && $pageSmall == 'Locaux')
	        <tr class="info">
       			<th class="col-md-1">Ad</th>
       			<th class="col-md-1">Ville</th>
       			<th class="col-md-1">Code postal</th>
       			<th class="col-md-1">Adresse</th>
       			<th class="col-md-1">Complément adresse</th>
       			<th class="col-md-1">Mentions complémentaires</th>
       			<th class="col-md-1">Superficie (m²)</th>
       			<th class="col-md-1">Structure(s)</th>
       			<th class="col-md-1">Date fin</th>
       			<th class="col-md-1">Date résiliation</th>
       		</tr>
       		@else
       		<tr class="info">
       			<th class="col-md-1">Ad</th>
       			<th class="col-md-1">Marque</th>
       			<th class="col-md-1">Model</th>
       			<th class="col-md-1">N° immat</th>
       			<th class="col-md-1">Date résiliation</th>
       			<th class="col-md-5">Motif</th>
       		</tr>
       		@endif
	    </thead>
	    <tbody>
        @forelse($historiques as $historique)
            
            @if($page == 'Historique' && $pageSmall == 'Locaux')
            <tr>
                <td rowspan="2">{{ $historique->ad }}</td> 
                <td>{{ $historique->ville_local }}</td>
                <td>{{ $historique->cp_local }}</td>
                <td>{{ $historique->adresse_local }}</td>
                <td>{{ $historique->apptEscalier }}</td>
                <td>{{ $historique->complementGeographique }}</td>
                <td>{{ $historique->superficie }}</td>
                <td>
                	@php 
                		$structures = explode(",", $historique->structure); 
                		
                		foreach($structures as $structure){
                			echo '<span class="badge btn-cat">'.$structure.'</span>';
                        }	                  
                	@endphp
                </td>
                <td>{{ $historique->date_fin->format('d/m/Y') }}</td>
                <td><b>{{ $historique->date_resiliation->format('d/m/Y') }}</b></td>
	        </tr>
	        <tr>
	        	<td colspan="" style="text-align: right;" ><b>Motif :</b></td>
	        	<td colspan="9">{{ $historique->motif}}</td>
	        </tr>
	        <tr>
	        	<td colspan="12" class="active"></td>
	        </tr>
	        @else
	        <tr>
	        	<td>{{ $historique->ad }}</td> 
	        	<td>{{ $historique->marque }}</td>
                <td>{{ $historique->model }}</td>
                <td>{{ $historique->immat }}</td>
                <td><b>{{ $historique->date_resiliation->format('d/m/Y') }}</b></td>
                <td>{{ $historique->motif }}</td>
	        </tr>
	        @endif
	        
        @empty
        @endforelse
	    </tbody>
	</table>
</div>

@endsection

@section('script')

    @if (count($errors) > 0)
        
        new Noty({
            type: 'error',
            layout: 'topRight',
            theme: 'mint',
            text: '{{ $errors->first()  }}',
            timeout: 2500,
            progressBar: true,
            closeWith: ['click', 'button'],
            animation: {
                open: 'noty_effects_open',
                close: 'noty_effects_close'
            },
            id: false,
            force: false,
            killer: false,
            queue: 'global',
            container: false,
            buttons: [],
            sounds: {
                sources: [],
                volume: 1,
                conditions: []
            },
            titleCount: {
            conditions: []
            },
            modal: false
        }).show()
    @endif
    @if (session('success'))

        new Noty({
            type: 'success',
            layout: 'topRight',
            theme: 'mint',
            text: '{{ session('success') }}',
            timeout: 2500,
            progressBar: true,
            closeWith: ['click', 'button'],
            animation: {
                open: 'noty_effects_open',
                close: 'noty_effects_close'
            },
            id: false,
            force: false,
            killer: false,
            queue: 'global',
            container: false,
            buttons: [],
            sounds: {
                sources: [],
                volume: 1,
                conditions: []
            },
            titleCount: {
            conditions: []
            },
            modal: false
        }).show()

    @endif

@stop