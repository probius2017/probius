@extends('layouts.admin')

@section('title', 'Edition Véhicules')

@section('content')

@if($vehicule->id)
<h1 class="page-header"><i class="fa fa-pencil-square-o"></i> {{$page}} <small>Edition du véhicule <b>"{{ $vehicule->immat}}"</b></small></h1>
@else
<h1 class="page-header"><i class="fa fa-pencil-square-o"></i> {{$page}} <small>Création nouveau véhicule</small></h1>
@endif

{{ Form::open(array('url' => $vehicule->id ? URL::route('listeVehicules.update', [$page, $pageSmall, $vehicule->id]) : URL::route('listeVehicules.store', [$page, $pageSmall]), 'method' => $vehicule->id ? 'put' : 'post')) }}

	<fieldset>
		<legend><i class="fa fa-info-circle" aria-hidden="true"></i> Informations principales du véhicule</legend>
	    <div class="flex-veh">
		    <div class="col-md-6 info-important">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group {!! $errors->has('marque_id') ? 'has-error' : '' !!} has-feedback">
		                	<label for="marque_id" class="control_label">Marque</label>
		                	<select name="marque_id" class="form-control" aria-describedby="error-updt">
		                		@forelse($marques as $marque)
		                  		<option value="{{ $marque->id }}" {{ $vehicule->marque->id == $marque->id ? 'selected' : ''}}>{{ $marque->name_marque }}</option>
		          				@empty
		          				@endforelse
		                	</select>
			                {!! $errors->first('marque_id', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
			                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		        	</div>

		        	<div class="col-md-4">
						<div class="form-group {!! $errors->has('modele_id') ? 'has-error' : '' !!} has-feedback">
		                	<label for="modele_id" class="control_label">Modèle</label>
		                	<select name="modele_id" class="form-control" aria-describedby="error-updt">
		                		@forelse($marques as $marque)
		                		<optgroup label="{{ $marque->name_marque}}">
		                			@forelse($marque->modeles as $modele)
			                  		<option value="{{ $modele->id }}" {{ $vehicule->modele->id == $modele->id ? 'selected' : ''}}>{{ $modele->name_modele }}</option>
			          				@empty
			          				@endforelse
			          			</optgroup>
			          			@empty
			          			@endforelse
		                	</select>
			                {!! $errors->first('modele_id', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
			                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		        	</div>

		        	<div class="col-md-4">
						<div class="form-group {!! $errors->has('category_id') ? 'has-error' : '' !!} has-feedback">
		                	<label for="category_id" class="control_label">Catégorie</label>
		                	<select name="category_id" class="form-control" aria-describedby="error-updt">
		                		@forelse($categories as $category)
		                  		<option value="{{ $category->id }}" {{ $vehicule->modele->category->id == $category->id ? 'selected' : ''}}>{{ $category->type }}</option>
		          				@empty
		          				@endforelse
		                	</select>
			                {!! $errors->first('category_id', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
			                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		        	</div>
		        </div>
		        <div class="row">
		        	<div class="col-md-4">
		            	<div class="form-group {!! $errors->has('immat') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('immat', 'Nouvelle Immat', array('class' => 'control_label')) !!}
		                {!! Form::text('immat', $vehicule->immat, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('immat', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		        	</div>
		        	<div class="col-md-4">
		            	<div class="form-group {!! $errors->has('old_immat') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('old_immat', 'Ancienne Immat', array('class' => 'control_label')) !!}
		                {!! Form::text('old_immat', $vehicule->old_immat, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('old_immat', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		        	</div>
		        </div>
		    </div>
		    <div class="col-md-3 info-important">
		    	<div class="row">
		    		<div class="col-md-12">
		            	<div class="form-group {!! $errors->has('pmc') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('pmc', 'Date PMC', array('class' => 'control_label')) !!}
		                @if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') == TRUE)
		                {!! Form::date('pmc', $vehicule->pmc->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                @elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') == TRUE)
		                {!! Form::date('pmc', $vehicule->pmc->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                @else
		                {!! Form::date('pmc', $vehicule->pmc, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                @endif
		                {!! $errors->first('pmc', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		        	</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-md-12">
		            	<div class="form-group {!! $errors->has('atp') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('atp', 'Date ATP', array('class' => 'control_label')) !!}
		                @if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') == TRUE)
		                {!! Form::date('atp', $vehicule->atp->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                @elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') == TRUE)
		                {!! Form::date('atp', $vehicule->atp->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                @else
		                {!! Form::date('atp', $vehicule->atp, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                @endif
		                {!! $errors->first('atp', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		        	</div>
		    	</div>
		    </div>
		    <div class="col-md-2 info-important">
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="form-group {!! $errors->has('garantie_id') ? 'has-error' : '' !!} has-feedback">
		                	<label for="garantie_id" class="control_label">Garantie(s)</label>
		                	<select name="garantie_id" class="form-control" aria-describedby="error-updt">
		                		@forelse($garanties as $garantie)
		                  		<option value="{{ $garantie->id }}" {{ $vehicule->contratV->garantie->id == $garantie->id ? 'selected' : ''}}>{{ $garantie->reference }}</option>
		          				@empty
		          				@endforelse
		                	</select>
			                {!! $errors->first('garantie_id', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
			                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>              	
		        	</div>
		    	</div>
		    </div>
		</div>
    </fieldset>
	<br>

	<div class="footer pull-right">
        <a href="{{ route('listeVehicules.index', [$page, $pageSmall]) }}" class="btn btn-default ">Annuler</a>
        @if($vehicule->id)
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