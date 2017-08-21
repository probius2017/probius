@extends('layouts.admin')

@section('title', 'historiques')

@section('content')

<h1 class="page-header"><i class="fa fa-building"></i> {{$page}} <small>{{$pageSmall}}</small></h1>

@include('partials.config-onglets')

<br>

<div class="">
	<table class="table table-striped table-hover">
	    <thead>
	        <tr>
       			@if($page == 'Historique' && $pageSmall == 'Locaux')
       			<th>Ad</th>
       			<th>Ville</th>
       			<th>Code postal</th>
       			<th>Adresse</th>
       			<th>Complément adresse</th>
       			<th>Mentions complémentaires</th>
       			<th>Superficie (m²)</th>
       			<th>Structure(s)</th>
       			<th>Date fin</th>
       			<th>Date résiliation</th>
       			<th>Motif</th>
       			@else
       			<th class="col-md-1">Ad</th>
       			<th class="col-md-1">Marque</th>
       			<th class="col-md-1">Model</th>
       			<th class="col-md-1">N° immat</th>
       			<th class="col-md-1">Date résiliation</th>
       			<th class="col-md-5">Motif</th>
       			@endif
       	
	        </tr>	
	    </thead>
	    <tbody>
        @forelse($historiques as $historique)
            
            <tr>
                <td>{{ $historique->ad }}</td> 

                @if($page == 'Historique' && $pageSmall == 'Locaux')
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
                <td>{{ $historique->motif }}</td>
                @else
                <td>{{ $historique->marque }}</td>
                <td>{{ $historique->model }}</td>
                <td>{{ $historique->immat }}</td>
                <td><b>{{ $historique->date_resiliation->format('d/m/Y') }}</b></td>
                <td>{{ $historique->motif }}</td>
                @endif

	        </tr>
	
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