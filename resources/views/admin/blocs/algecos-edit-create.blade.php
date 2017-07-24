@extends('layouts.admin')

@section('title', 'Edition Algécos')

@section('content')

@if($algeco->id)
<h1 class="page-header"><i class="fa fa-pencil-square-o"></i> Algécos <small>Edition de l'algéco n° {{ $algeco->id}}</small></h1>
@else
<h1 class="page-header"><i class="fa fa-pencil-square-o"></i> Algécos <small>Création nouveau algéco</small></h1>
@endif

{{ Form::open(array('url' => $algeco->id ? URL::route('listeAlgecos.update', [$page, $pageSmall, $algeco->id]) : URL::route('listeAlgecos.store', [$page, $pageSmall]), 'method' => $algeco->id ? 'put' : 'post')) }}

	<fieldset>
        <legend><i class="fa fa-info-circle" aria-hidden="true"></i> Informations principales de l'Algéco</legend>
        <div class="col-md-12 info-important">
        	<div class="col-md-3">
        		<div class="row">
        			<div class="col-md-12">
                    	<div class="form-group {!! $errors->has('ville_algeco') ? 'has-error' : '' !!} has-feedback">
                        {!! Form::label('ville_algeco', 'Ville', array('class' => 'control_label')) !!}
                        {!! Form::text('ville_algeco', $algeco->ville_algeco, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                        {!! $errors->first('ville_algeco', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
                    	</div>
                	</div>
                </div>
                <div class="row">
                	<div class="col-md-8">
                    <div class="form-group {!! $errors->has('cp_algeco') ? 'has-error' : '' !!} has-feedback">
                        {!! Form::label('cp_algeco', 'Code Postal', array('class' => 'control_label')) !!}
                        {!! Form::text('cp_algeco', $algeco->cp_algeco, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                        {!! $errors->first('cp_algeco', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
                    </div>
                	</div>
                </div>
        	</div>
        	<div class="col-md-6">
        		<div class="row">
                	<div class="col-md-12">
                		<div class="form-group {!! $errors->has('adresse_algeco') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('adresse_algeco', 'Adresse', array('class' => 'control_label')) !!}
		                {!! Form::text('adresse_algeco', $algeco->adresse_algeco, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('adresse_algeco', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
                	</div>
            	</div>
            	<div class="row">
	                <div class="col-md-6">
	                    <div class="form-group {!! $errors->has('complementGeographique') ? 'has-error' : '' !!} has-feedback">
	                        {!! Form::label('complementGeographique', 'Complément adresse', array('class' => 'control_label')) !!}
	                        {!! Form::text('complementGeographique', $algeco->complementGeographique, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
	                        {!! $errors->first('complementGeographique', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
	                        <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group {!! $errors->has('apptEscalier') ? 'has-error' : '' !!} has-feedback">
	                        {!! Form::label('apptEscalier', 'Mentions complémentaires', array('class' => 'control_label')) !!}
	                        {!! Form::text('apptEscalier', $algeco->apptEscalier, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
	                        {!! $errors->first('apptEscalier', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
	                        <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
	                    </div>
	                </div>
        		</div>
        	</div>
            <div class="col-md-3">
        		<div class="form-group {!! $errors->has('type_algeco') ? 'has-error' : '' !!} has-feedback">
                <label for="type_algeco" class="control_label">Type de Algéco</label>
                <select name="type_algeco" class="form-control" aria-describedby="error-updt">
                  	<option value="Chalet bois" {{ $algeco->type_algeco == 'Chalet bois' ? 'selected' : ''}}>Chalet bois</option>
                  	<option value="Bungalow" {{ $algeco->type_algeco == 'Bungalow' ? 'selected' : ''}}>Bungalow</option>
                </select>
                {!! $errors->first('type_algeco', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            	</div>
            </div>
        </div>
    </fieldset>

    <br>

    <fieldset>
        <legend><i class="fa fa-info-circle" aria-hidden="true"></i> Autres Informations liées au bail</legend>

        <div class="col-md-6">
            <div class="form-group {!! $errors->has('type_document') ? 'has-error' : '' !!} has-feedback">
                <label for="type_document" class="control_label">Type de document</label>
                <select name="type_document" class="form-control" aria-describedby="error-updt">
                  <option value="Bail Civil" {{ $bail->type_document == 'Bail Civil' ? 'selected' : ''}}>Bail Civil</option>
                  <option value="Bail Commercial" {{ $bail->type_document == 'Bail Commercial' ? 'selected' : ''}}>Bail Commercial</option>
                  <option value="Bail amphytheotique" {{ $bail->type_document == 'Bail amphytheotique' ? 'selected' : ''}}>Bail amphytheotique</option>
                  <option value="Conventions" {{ $bail->type_document == 'Conventions' ? 'selected' : ''}}>Conventions</option>
                  <option value="Autres" {{ $bail->type_document == 'Autres' ? 'selected' : ''}}>Autres</option>
                </select>
                {!! $errors->first('type_document', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>
            @if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') == TRUE)
            <div class="form-group {!! $errors->has('date_debut') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('date_debut', 'Date de début', array('class' => 'control_label')) !!}
                {!! Form::text('date_debut', $bail->date_debut->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                {!! $errors->first('date_debut', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>
            <div class="form-group {!! $errors->has('date_signature') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('date_signature', 'Date de signature', array('class' => 'control_label')) !!}
                {!! Form::text('date_signature', $bail->date_signature->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                {!! $errors->first('date_signature', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>
            <div class="form-group {!! $errors->has('date_fin') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('date_fin', 'Date de fin de bail', array('class' => 'control_label')) !!}
                {!! Form::text('date_fin', $bail->date_fin->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                {!! $errors->first('date_fin', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>
            @elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') == TRUE)
            <div class="form-group {!! $errors->has('date_debut') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('date_debut', 'Date de début', array('class' => 'control_label')) !!}
                {!! Form::text('date_debut', $bail->date_debut->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                {!! $errors->first('date_debut', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>
            <div class="form-group {!! $errors->has('date_signature') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('date_signature', 'Date de signature', array('class' => 'control_label')) !!}
                {!! Form::text('date_signature', $bail->date_signature->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                {!! $errors->first('date_signature', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>
            <div class="form-group {!! $errors->has('date_fin') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('date_fin', 'Date de fin de bail', array('class' => 'control_label')) !!}
                {!! Form::text('date_fin', $bail->date_fin->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                {!! $errors->first('date_fin', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>
            @else
            <div class="form-group {!! $errors->has('date_debut') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('date_debut', 'Date de début', array('class' => 'control_label')) !!}
                {!! Form::date('date_debut', $bail->date_debut, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                {!! $errors->first('date_debut', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>
            <div class="form-group {!! $errors->has('date_signature') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('date_signature', 'Date de signature', array('class' => 'control_label')) !!}
                {!! Form::date('date_signature', $bail->date_signature, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                {!! $errors->first('date_signature', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>
            <div class="form-group {!! $errors->has('date_fin') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('date_fin', 'Date de fin de bail', array('class' => 'control_label')) !!}
                {!! Form::date('date_fin', $bail->date_fin, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                {!! $errors->first('date_fin', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>
            @endif
            <div class="form-group {!! $errors->has('duree_ini') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('duree_ini', 'Durée initiale (jours)', array('class' => 'control_label')) !!}
                {!! Form::text('duree_ini', $bail->duree_ini, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                {!! $errors->first('duree_ini', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>
            <div class="form-group {!! $errors->has('tacite_reconduction') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('tacite_reconduction', 'Reconduction tacite', array('class' => 'control_label')) !!}
                {{ Form::select('tacite_reconduction', ['Non', 'Oui'], $bail->tacite_reconduction,  ['class' => 'form-control', 'aria-describedby' => 'error-updt']) }}
                {!! $errors->first('tacite_reconduction', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>
        </div>     
            
        <div class="col-md-6">
            <div class="form-group {!! $errors->has('reconduction_description') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('reconduction_description', 'Description de la reconduction', array('class' => 'control_label')) !!}
                {!! Form::textarea('reconduction_description', $bail->reconduction_description, ['class' => 'form-control', 'aria-describedby' => 'error-updt', 'rows' => 3]) !!}
                {!! $errors->first('reconduction_description', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>
            <div class="form-group {!! $errors->has('clause') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('clause', 'Clause', array('class' => 'control_label')) !!}
                {{ Form::select('clause', ['Résiliation', 'Résolutoire'], $bail->clause == 'résiliation' ? 0 : 1,  ['class' => 'form-control', 'aria-describedby' => 'error-updt']) }}
                {!! $errors->first('clause', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>
            <div class="form-group {!! $errors->has('description_clause') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('description_clause', 'Description de la clause', array('class' => 'control_label')) !!}
                {!! Form::textarea('description_clause', $bail->description_clause, ['class' => 'form-control', 'aria-describedby' => 'error-updt', 'rows' => 3]) !!}
                {!! $errors->first('description_clause', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>
            <div class="form-group {!! $errors->has('quantite_site') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('quantite_site', 'Quantité de site', array('class' => 'control_label')) !!}
                {!! Form::number('quantite_site', $bail->quantite_site, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                {!! $errors->first('quantite_site', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>
        </div>  
    </fieldset>

    <br>

	<div class="footer pull-right">
        <a href="{{ route('listeAlgecos.index', [$page, $pageSmall]) }}" class="btn btn-default ">Annuler</a>
        @if($algeco->id)
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