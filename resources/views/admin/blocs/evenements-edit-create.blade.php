@extends('layouts.admin')

@section('title', 'Edition Evènements')

@section('content')

@if($evenement->id)
<h1 class="page-header"><i class="fa fa-pencil-square-o"></i> Evènement <small>Edition de l'évènement <b>"{{ $evenement->id }}"</b></small></h1>
@else
<h1 class="page-header"><i class="fa fa-pencil-square-o"></i> {{$page}} <small>Création nouvel évènement</small></h1>
@endif

{{ Form::open(array('url' => $evenement->id ? URL::route('listeEvenements.update', [$page, $pageSmall, $evenement->id]) : URL::route('listeEvenements.store', [$page, $pageSmall]), 'method' => $evenement->id ? 'put' : 'post')) }}

	<fieldset>
		<legend><i class="fa fa-info-circle" aria-hidden="true"></i> Informations principales de l'évènement</legend>
	    <div class="flex-veh">
		    <div class="col-md-4 info-important">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group {!! $errors->has('nom_salle') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('nom_salle', 'Nom salle', array('class' => 'control_label')) !!}
		                {!! Form::text('nom_salle', $evenement->nom_salle, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('nom_salle', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		        	</div>
		        </div>
		        <div class="row">
		        	<div class="col-md-10">
		        		<div class="form-group {!! $errors->has('adresse_event') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('adresse_event', 'Adresse', array('class' => 'control_label')) !!}
		                {!! Form::text('adresse_event', $evenement->adresse_event, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('adresse_event', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		            </div>
		        </div>
		        <div class="row">
		        	<div class="col-md-4">
		        		<div class="form-group {!! $errors->has('cp_event') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('cp_event', 'Code postal', array('class' => 'control_label')) !!}
		                {!! Form::text('cp_event', $evenement->cp_event, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('cp_event', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		            </div>
		        </div>
		        <div class="row">
		        	<div class="col-md-7">
		        		<div class="form-group {!! $errors->has('ville_event') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('ville_event', 'Ville', array('class' => 'control_label')) !!}
		                {!! Form::text('ville_event', $evenement->ville_event, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('ville_event', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		            </div>
		        </div>
		    </div>

		    <div class="col-md-3 info-important">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group {!! $errors->has('nom_event') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('nom_event', 'Nom évènement', array('class' => 'control_label')) !!}
		                {!! Form::text('nom_event', $evenement->nom_event, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('nom_event', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		        	</div>
		        </div>
		        <div class="row">
		    		<div class="col-md-8">
		    			<div class="form-group {!! $errors->has('type_event') ? 'has-error' : '' !!} has-feedback">
		                <label for="type_event" class="control_label">Type évènement</label>
		                <select name="type_event" class="form-control" aria-describedby="error-updt">
		                  <option value="Manif" {{ $evenement->type_event == 'Manif' ? 'selected' : ''}}>Manif</option>
		                  <option value="Réunion" {{ $evenement->type_event == 'Reunion' ? 'selected' : ''}}>Réunion</option>
		                </select>
		                {!! $errors->first('type_event', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		    		</div>
		    	</div>
		        <div class="row">
		        	<div class="col-md-5">
		        		<div class="form-group {!! $errors->has('duree_event') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('duree_event', 'Durée (jours)', array('class' => 'control_label')) !!}
		                {!! Form::text('duree_event', $evenement->duree_event, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('duree_event', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		            </div>
		        </div>
		        <div class="row">
		        	<div class="col-md-9">
		    			<div class="form-group {!! $errors->has('statut_event') ? 'has-error' : '' !!} has-feedback">
                        {!! Form::label('statut_event', 'Statut évènement', array('class' => 'control_label')) !!}
                        {{ Form::select('statut_event', ['Non clôturé (0)', 'Clôturé (1)'], $evenement->statut_event,  ['class' => 'form-control', 'aria-describedby' => 'error-updt']) }}
                        {!! $errors->first('statut_event', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
                    </div>
		    		</div>
		        </div>
		    </div>

		    <div class="col-md-4 info-important">
		    	<div class="row">
		    		@if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') == TRUE)
		    		<div class="col-md-8">
		    			<div class="form-group {!! $errors->has('date_demande') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('date_demande', 'Date demande', array('class' => 'control_label')) !!}
		                {!! Form::text('date_demande', $evenement->date_demande->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('date_demande', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		    		</div>
		    		<div class="col-md-8">
		    			<div class="form-group {!! $errors->has('date_reponse') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('date_reponse', 'Date réponse', array('class' => 'control_label')) !!}
		                {!! Form::text('date_reponse', $evenement->date_reponse->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('date_reponse', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		    		</div>
		    		@elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') == TRUE)
		    		<div class="col-md-6">
		    			<div class="form-group {!! $errors->has('date_demande') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('date_demande', 'Date demande', array('class' => 'control_label')) !!}
		                {!! Form::text('date_demande', $evenement->date_demande->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('date_demande', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		    		</div>
		    		<div class="col-md-6">
		    			<div class="form-group {!! $errors->has('date_reponse') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('date_reponse', 'Date réponse', array('class' => 'control_label')) !!}
		                {!! Form::text('date_reponse', $evenement->date_reponse->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('date_reponse', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		    		</div>
		    		@else
		    		<div class="col-md-8">
		    			<div class="form-group {!! $errors->has('date_demande') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('date_demande', 'Date demande', array('class' => 'control_label')) !!}
		                {!! Form::date('date_demande', $evenement->date_demande, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('date_demande', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		    		</div>
		    		<div class="col-md-8">
		    			<div class="form-group {!! $errors->has('date_reponse') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('date_reponse', 'Date réponse', array('class' => 'control_label')) !!}
		                {!! Form::date('date_reponse', $evenement->date_reponse, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('date_reponse', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		    		</div>
		    		@endif

		    	</div>
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="form-group {!! $errors->has('remarque') ? 'has-error' : '' !!} has-feedback">
			                {!! Form::label('remarque', 'Remarque', array('class' => 'control_label')) !!}
			                {!! Form::textarea('remarque', $evenement->remarque, ['class' => 'form-control', 'aria-describedby' => 'error-updt', 'rows' => 5]) !!}
			                {!! $errors->first('remarque', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
			                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
			            </div>
		    		</div>
		    	</div>
		    </div>
		</div>
    </fieldset>

	<br>

	<div class="footer pull-right">
        <a href="{{ route('listeEvenements.index', [$page, $pageSmall]) }}" class="btn btn-default ">Annuler</a>
        @if($evenement->id)
        <button type="submit" class="btn btn-extia ">Sauvegarder <i class="fa fa-check"></i></button>
        @else
        <button type="submit" class="btn btn-extia ">Créer <i class="fa fa-check"></i></button>
        @endif
    </div>
{{ Form::close() }}


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