<!DOCTYPE html>
<html>
    <head>
        <title>Probius</title>
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                
            	<table class="table table-striped table-hover">
				    <thead>
				        <tr>
				        	@if($page == 'Evenements')
				        		<th><b>#</b></th>
				        	@else
				        		<th><B>N° AD</B></th>
				        	@endif
				        	@forelse($champs as $champ)
				        	<th>{{ $champ->new_name }}</th>
				        	@empty
				        	@endforelse

				        	@if($page == 'Historique')
				        		@if($pageSmall == 'Locaux')
				        		<th>Structure(s)</th>
				        		<th>Date de fin</th>
				        		@endif
				        	<th>Date résiliation</th>
				        	<th>Motif</th>
				        	@endif

				        	@if($page == 'Locaux' || $page == 'ACI' || $page == 'AN' || $page == 'Entrepots' || $page == 'Chambres-froides')
				        	<td><b>Nb ch.froides</b></td>
				        	@endif

				        	@if($page == 'Chambres-froides')
				        	<th>Volume (m3)</th>
				        	@endif
				        </tr>	
				    </thead>
				    <tbody>
				        @forelse($data as $d)
				        <tr>
				        	@if($page == 'Evenements')
				        	<td>{{ $d->id }}</td>
				        	@elseif($page == 'Sinistres')
				        		@if($pageSmall == 'Mas')
				        			@if($d->contrat->local_id != null)
				        			<td>{{ $d->contrat->local->ad->numero_ad }}</td>
				        			@elseif($d->contrat->algeco_id != null)
				        			<td>{{ $d->contrat->algeco->ad->numero_ad }}</td>
				        			@elseif($d->contrat->logement_id != null)
				        			<td>{{ $d->contrat->logement->ad->numero_ad }}</td>
				        			@endif
				        		@else
				        		<td>{{ $d->contratV->vehicule->ad->numero_ad }}</td>
				        		@endif
				        	@elseif($page == 'Historique')
				        	<td>{{ $d->ad }}</td>
				        	@else
				        	<td>{{ $d->ad->numero_ad }}</td>
				        	@endif

				        	@forelse($champs as $c)
				        		@if($c->old_name == 'date_debut' || $c->old_name == 'date_signature' || $c->old_name == 'date_fin' || $c->old_name == 'pmc' || $c->old_name == 'atp' || $c->old_name == 'date_demande' || $c->old_name == 'date_reponse' || $c->old_name == 'date_reception' || $c->old_name == 'date_ouverture' || $c->old_name == 'date_sinistre')
				        		<th>{{ $d[$c->old_name]->format('d/m/Y') }}</th>
				        		@elseif(!empty($d->date_cloture) && $c->old_name == 'date_cloture')
				        		<th>{{ $d[$c->old_name]->format('d/m/Y') }}</th>
				        		@else
				        		<td>{{ $d[$c->old_name] }}</td>
				        		@endif
				        	@empty
				        	@endforelse

				        	@if($page == 'Historique')
				        		@if($pageSmall == 'Locaux')
				        		<td>{{ $d->structure }}</td>
				        		<td>{{ $d->date_fin->format('d/m/Y') }}</td>
				        		@endif
				        	<td>{{ $d->date_resiliation->format('d/m/Y') }}</td>
				        	<td>{{ $d->motif }}</td>
				        	@endif

				        	@if($page == 'Locaux' || $page == 'ACI' || $page == 'AN' || $page == 'Entrepots' || $page == 'Chambres-froides')
				        	<td>{{ $d->chambresFroides->count() }}</td>
				        	@endif

				        	@if($page == 'Chambres-froides')
				        		@forelse($d->chambresFroides as $cf)
				        		<td>{{ $cf->volume }}</td>
				        		@empty
				        		@endforelse
				        	@endif
				        </tr>
			            @empty
				        @endforelse
				    </tbody>
				</table>
            </div>
        </div>
    </body>
</html>


