@extends('layouts.admin')

@section('title', 'Edition Sinistres')

@section('content')

@if($sinistre->id)
<h1 class="page-header"><i class="fa fa-pencil-square-o"></i> {{$page}} <small>Edition du sinistre <b>"{{ $sinistre->ref_macif}}" (ref macif)</b></small></h1>
@else
<h1 class="page-header"><i class="fa fa-pencil-square-o"></i> {{$page}} <small>Création nouveau sinistre</small></h1>
@endif

@if($pageSmall == 'Mas')
{{ Form::open(array('url' => $sinistre->id ? URL::route('listeSinistresMasse.update', [$page, $pageSmall, $sinistre->id]) : URL::route('listeSinistresMasse.store', [$page, $pageSmall]), 'method' => $sinistre->id ? 'put' : 'post')) }}
@else
{{ Form::open(array('url' => $sinistre->id ? URL::route('listeSinistresVehicules.update', [$page, $pageSmall, $sinistre->id]) : URL::route('listeSinistresVehicules.store', [$page, $pageSmall]), 'method' => $sinistre->id ? 'put' : 'post')) }}
@endif

	<fieldset>
		<legend><i class="fa fa-info-circle" aria-hidden="true"></i> Informations principales du Sinistre</legend>
	    <div class="flex-veh">
		    <div class="col-md-3 info-important">
				<div class="row">
					<div class="col-md-10">
						<div class="form-group {!! $errors->has('ref_macif') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('ref_macif', 'Référence MACIF', array('class' => 'control_label')) !!}
		                {!! Form::text('ref_macif', $sinistre->ref_macif, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('ref_macif', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		        	</div>
		        </div>
		        <div class="row">
		        	<div class="col-md-10">
		        		<div class="form-group {!! $errors->has('ref_rdc') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('ref_rdc', 'Référence RDC', array('class' => 'control_label')) !!}
		                {!! Form::text('ref_rdc', $sinistre->ref_rdc, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('ref_rdc', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		            </div>
		        </div>
		        <div class="row">
		        	<div class="col-md-10">
		        		<div class="form-group {!! $errors->has('ville_sinistre') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('ville_sinistre', 'Ville du sinistre', array('class' => 'control_label')) !!}
		                {!! Form::text('ville_sinistre', $sinistre->ville_sinistre, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('ville_sinistre', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		            </div>
		        </div>
		    </div>

		    @if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') == TRUE)
		    <div class="col-md-3 info-important">
		    	<div class="row">
		    		<div class="col-md-10">
		    			<div class="form-group {!! $errors->has('date_reception') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('date_reception', 'Date réception', array('class' => 'control_label')) !!}
		                {!! Form::text('date_reception', $sinistre->date_reception->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('date_reception', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-md-10">
		    			<div class="form-group {!! $errors->has('date_ouverture') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('date_ouverture', 'Date ouverture', array('class' => 'control_label')) !!}
		                {!! Form::text('date_ouverture', $sinistre->date_ouverture->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('date_ouverture', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-md-10">
		    			<div class="form-group {!! $errors->has('date_sinistre') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('date_sinistre', 'Date du sinistre', array('class' => 'control_label')) !!}
		                {!! Form::text('date_sinistre', $sinistre->date_sinistre->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('date_sinistre', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		    		</div>
		    	</div>
		    </div>
		    @elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') == TRUE)
		    <div class="col-md-3 info-important">
		    	<div class="row">
		    		<div class="col-md-10">
		    			<div class="form-group {!! $errors->has('date_reception') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('date_reception', 'Date réception', array('class' => 'control_label')) !!}
		                {!! Form::text('date_reception', $sinistre->date_reception->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('date_reception', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-md-10">
		    			<div class="form-group {!! $errors->has('date_ouverture') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('date_ouverture', 'Date ouverture', array('class' => 'control_label')) !!}
		                {!! Form::text('date_ouverture', $sinistre->date_ouverture->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('date_ouverture', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-md-10">
		    			<div class="form-group {!! $errors->has('date_sinistre') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('date_sinistre', 'Date du sinistre', array('class' => 'control_label')) !!}
		                {!! Form::text('date_sinistre', $sinistre->date_sinistre->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('date_sinistre', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		    		</div>
		    	</div>
		    </div>
		    @else
		    <div class="col-md-3 info-important">
		    	<div class="row">
		    		<div class="col-md-10">
		    			<div class="form-group {!! $errors->has('date_reception') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('date_reception', 'Date réception', array('class' => 'control_label')) !!}
		                {!! Form::date('date_reception', $sinistre->date_reception, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('date_reception', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-md-10">
		    			<div class="form-group {!! $errors->has('date_ouverture') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('date_ouverture', 'Date ouverture', array('class' => 'control_label')) !!}
		                {!! Form::date('date_ouverture', $sinistre->date_ouverture, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('date_ouverture', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-md-10">
		    			<div class="form-group {!! $errors->has('date_sinistre') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('date_sinistre', 'Date du sinistre', array('class' => 'control_label')) !!}
		                {!! Form::date('date_sinistre', $sinistre->date_sinistre, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('date_sinistre', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		    		</div>
		    	</div>
		    </div>
		    @endif

		    <div class="col-md-5 info-important">
		    	<div class="row">
		    		<div class="col-md-4">
		    			<div class="form-group {!! $errors->has('responsabilite') ? 'has-error' : '' !!} has-feedback">
		                <label for="responsabilite" class="control_label">Responsabilité</label>
		                <select name="responsabilite" class="form-control" aria-describedby="error-updt">
		                  <option value="0%" {{ $sinistre->responsabilite == '0%' ? 'selected' : ''}}>0 %</option>
		                  <option value="50%" {{ $sinistre->responsabilite == '50%' ? 'selected' : ''}}>50 %</option>
		                  <option value="100%" {{ $sinistre->responsabilite == '100%' ? 'selected' : ''}}>100 %</option>
		                </select>
		                {!! $errors->first('responsabilite', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		    		</div>
		    		<div class="col-md-7">
		    			<div class="form-group {!! $errors->has('type_sinistre_id') ? 'has-error' : '' !!} has-feedback">
			                <label for="type_sinistre_id" class="control_label">Type du sinistre</label>
			                <select name="type_sinistre_id" class="form-control" aria-describedby="error-updt">
			                  @forelse($typesSinistre as $type)
			                  <option value="{{ $type->id }}" {{ $sinistre->type_sinistre_id == $type->id ? 'selected' : ''}}>{{ $type->ref }}</option>
			                  @empty
	                          @endforelse
			                </select>
			                {!! $errors->first('type_sinistre_id', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
			                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="form-group {!! $errors->has('observation') ? 'has-error' : '' !!} has-feedback">
			                {!! Form::label('observation', 'Description de la clause', array('class' => 'control_label')) !!}
			                {!! Form::textarea('observation', $sinistre->observation, ['class' => 'form-control', 'aria-describedby' => 'error-updt', 'rows' => 5]) !!}
			                {!! $errors->first('observation', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
			                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
			            </div>
		    		</div>
		    	</div>
		    </div>
		</div>
    </fieldset>

	<br>

	<div class="flex-sin">
		<fieldset>
			<legend><i class="fa fa-info-circle" aria-hidden="true"></i> Informations financières concernant le sinistre</legend>
			<div class="col-md-7 info-important">
				<div class="row">
					<div class="col-md-7">
						<div class="form-group {!! $errors->has('reglement_macif') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('reglement_macif', 'Règlement MACIF', array('class' => 'control_label')) !!}
		                {!! Form::number('reglement_macif', $sinistre->reglement_macif, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('reglement_macif', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
			            </div>
		        	</div>
		        </div>
		        <div class="row">
		        	<div class="col-md-7">
		        		<div class="form-group {!! $errors->has('franchise') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('franchise', 'Règlement MACIF', array('class' => 'control_label')) !!}
		                {!! Form::number('franchise', $sinistre->franchise, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('franchise', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
			            </div>
		            </div>
		        </div>
		        <div class="row">
		        	<div class="col-md-7">
		        		<div class="form-group {!! $errors->has('solde_ad') ? 'has-error' : '' !!} has-feedback">
		                {!! Form::label('solde_ad', 'Règlement MACIF', array('class' => 'control_label')) !!}
		                {!! Form::number('solde_ad', $sinistre->solde_ad, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                {!! $errors->first('solde_ad', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
			            </div>
		            </div>
		        </div>
		    </div>
		</fieldset>

		<div class="marge-div"></div>

		<fieldset>
			<legend><i class="fa fa-info-circle" aria-hidden="true"></i> Date de clôture du sinistre</legend>
			<div class="col-md-10 info-important">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group {!! $errors->has('date_cloture') ? 'has-error' : '' !!} has-feedback">
		                

		            @if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') == TRUE)
		            	{!! Form::label('date_cloture', 'Date de clôture (j/m/aaaa)', array('class' => 'control_label')) !!}
		                @if($sinistre->date_cloture != null)
		                {!! Form::text('date_cloture', $sinistre->date_cloture->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                @else
		                {!! Form::text('date_cloture', '', ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                @endif
		            @elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') == TRUE)
		            	{!! Form::label('date_cloture', 'Date de clôture (j/m/aaaa)', array('class' => 'control_label')) !!}
		            	@if($sinistre->date_cloture != null)
		                {!! Form::text('date_cloture', $sinistre->date_cloture->format('d/m/Y'), ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                @else
		                {!! Form::text('date_cloture', '', ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                @endif
		            @else
		            	{!! Form::label('date_cloture', 'Date de clôture', array('class' => 'control_label')) !!}
		            	@if($sinistre->date_cloture != null)
		                {!! Form::date('date_cloture', $sinistre->date_cloture, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                @else
		                {!! Form::date('date_cloture', '', ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
		                @endif
		            @endif
		                {!! $errors->first('date_cloture', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
		                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
		            	</div>
		        	</div>
		        </div>
		    </div>
		</fieldset>
	</div>

	<br>

	<div class="footer pull-right">
        @if($pageSmall == 'Mas')
        <a href="{{ route('listeSinistresMasse.index', [$page, $pageSmall]) }}" class="btn btn-default ">Annuler</a>
        @else
        <a href="{{ route('listeSinistresVehicules.index', [$page, $pageSmall]) }}" class="btn btn-default ">Annuler</a>
        @endif

        @if($sinistre->id)
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