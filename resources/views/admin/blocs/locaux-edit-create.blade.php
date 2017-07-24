@extends('layouts.admin')

@section('title', 'Edition local')

@section('content')

@if($local->id)
<h1 class="page-header"><i class="fa fa-pencil-square-o"></i> Locaux <small>Edition du local n° {{ $local->id}}</small></h1>
@else
<h1 class="page-header"><i class="fa fa-pencil-square-o"></i> Locaux <small>Création nouveau local</small></h1>
@endif


@if($page == 'Locaux')
{{ Form::open(array('url' => $local->id ? URL::route('listeLocaux.update', [$page, $pageSmall, $local->id]) : URL::route('listeLocaux.store', [$page, $pageSmall]), 'method' => $local->id ? 'put' : 'post')) }}
@elseif($page == 'ACI' && $pageSmall == '>50RI')
{{ Form::open(array('url' => $local->id ? URL::route('listeACI.update', [$page, $pageSmall, $local->id]) : URL::route('listeACI.store', [$page, $pageSmall]), 'method' => $local->id ? 'put' : 'post')) }}
@elseif($page == 'ACI' && $pageSmall == 'RCPRO')
{{ Form::open(array('url' => $local->id ? URL::route('listeAciRCPRO.update', [$page, $pageSmall, $local->id]) : URL::route('listeAciRCPRO.store', [$page, $pageSmall]), 'method' => $local->id ? 'put' : 'post')) }}
@elseif($page == 'Entrepots')
{{ Form::open(array('url' => $local->id ? URL::route('listeEntrepots.update', [$page, $pageSmall, $local->id]) : URL::route('listeEntrepots.store', [$page, $pageSmall]), 'method' => $local->id ? 'put' : 'post')) }}
@elseif($page == 'AN')
{{ Form::open(array('url' => $local->id ? URL::route('listeBiensAN.update', [$page, $pageSmall, $local->id]) : URL::route('listeBiensAN.store', [$page, $pageSmall]), 'method' => $local->id ? 'put' : 'post')) }}
@endif
    <fieldset>
        <legend><i class="fa fa-info-circle" aria-hidden="true"></i> Informations principales du local</legend>

        <div class="col-md-6 info-important">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {!! $errors->has('ville_local') ? 'has-error' : '' !!} has-feedback">
                        {!! Form::label('ville_local', 'Ville', array('class' => 'control_label')) !!}
                        {!! Form::text('ville_local', $local->ville_local, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                        {!! $errors->first('ville_local', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {!! $errors->has('cp_local') ? 'has-error' : '' !!} has-feedback">
                        {!! Form::label('cp_local', 'Code Postal', array('class' => 'control_label')) !!}
                        {!! Form::text('cp_local', $local->cp_local, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                        {!! $errors->first('cp_local', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
                    </div>
                </div>
            </div>
            
            <div class="form-group {!! $errors->has('adresse_local') ? 'has-error' : '' !!} has-feedback">
                    {!! Form::label('adresse_local', 'Adresse', array('class' => 'control_label')) !!}
                    {!! Form::text('adresse_local', $local->adresse_local, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                    {!! $errors->first('adresse_local', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                    <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {!! $errors->has('complementGeographique') ? 'has-error' : '' !!} has-feedback">
                        {!! Form::label('complementGeographique', 'Complément adresse', array('class' => 'control_label')) !!}
                        {!! Form::text('complementGeographique', $local->complementGeographique, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                        {!! $errors->first('complementGeographique', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {!! $errors->has('apptEscalier') ? 'has-error' : '' !!} has-feedback">
                        {!! Form::label('apptEscalier', 'Mentions complémentaires', array('class' => 'control_label')) !!}
                        {!! Form::text('apptEscalier', $local->apptEscalier, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                        {!! $errors->first('apptEscalier', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5 col-md-offset-1 info-important">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group {!! $errors->has('superficie') ? 'has-error' : '' !!} has-feedback">
                        {!! Form::label('superficie', 'Superficie (m²)', array('class' => 'control_label')) !!}
                        {!! Form::text('superficie', $local->superficie, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                        {!! $errors->first('superficie', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
                    </div>

                    <div class="form-group {!! $errors->has('ERP') ? 'has-error' : '' !!} has-feedback">
                        {!! Form::label('ERP', 'ERP', array('class' => 'control_label')) !!}
                        {{ Form::select('ERP', ['Non', 'Oui'], $local->ERP,  ['class' => 'form-control', 'aria-describedby' => 'error-updt']) }}
                        {!! $errors->first('ERP', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
                    </div>

                    <div class="form-group {!! $errors->has('contenu') ? 'has-error' : '' !!} has-feedback">
                        {!! Form::label('contenu', 'Contenu (&euro;)', array('class' => 'control_label')) !!}
                        {!! Form::number('contenu', $local->contenu, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                        {!! $errors->first('contenu', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-1">
                    <div class="form-group {!! $errors->has('type_structure') ? 'has-error' : '' !!} has-feedback">
                        <label for="type_structure">Type(s) de structure(s)</label>
                        <table id="cat-table">
                            @forelse($structures as $structure)
                            <tr>
                                <td>{{ $structure->type_structure }}</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>
                                    {!! Form::checkbox('type_structure[]', $structure->id, $local->isStruc($structure->id) ? true : false) !!}
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </table>
                        {!! $errors->first('type_structure', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
                
    <br>
    <br>
                
    <fieldset>
        <legend><i class="fa fa-info-circle" aria-hidden="true"></i> Autres Informations liées au local</legend>

        <div class="col-md-6">

            <div class="form-group {!! $errors->has('precaire') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('precaire', 'Précaire', array('class' => 'control_label')) !!}
                {{ Form::select('precaire', ['Non', 'Oui'], $local->precaire,  ['class' => 'form-control', 'aria-describedby' => 'error-updt']) }}
                {!! $errors->first('precaire', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has('etat_ini') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('etat_ini', 'Etat initial', array('class' => 'control_label')) !!}
                {{ Form::select('etat_ini', ['Parfait état', 'Remise en état fin de bail'], $local->etat_ini == 'parfait état' ? 0 : 1,  ['class' => 'form-control', 'aria-describedby' => 'error-updt']) }}
                {!! $errors->first('etat_ini', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has('nom_bailleur') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('nom_bailleur', 'Nom du bailleur', array('class' => 'control_label')) !!}
                {!! Form::text('nom_bailleur', $local->nom_bailleur, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                {!! $errors->first('nom_bailleur', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has('info_bailleur') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('info_bailleur', 'Info sur le bailleur', array('class' => 'control_label')) !!}
                {{ Form::select('info_bailleur', ['AN', 'Privé', 'Publique'], $local->info_bailleur,  ['class' => 'form-control', 'aria-describedby' => 'error-updt']) }}
                {!! $errors->first('info_bailleur', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has('loyer') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('loyer', 'Loyer', array('class' => 'control_label')) !!}
                {!! Form::text('loyer', $local->loyer, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                {!! $errors->first('loyer', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has('detail_loyer') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('detail_loyer', 'Détail loyer', array('class' => 'control_label')) !!}
                {{ Form::select('detail_loyer', ['TVA', 'NET'], $local->detail_loyer == 'TVA' ? 0 : 1,  ['class' => 'form-control', 'aria-describedby' => 'error-updt']) }}
                {!! $errors->first('info_bailleur', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has('pret') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('pret', 'Prêt', array('class' => 'control_label')) !!}
                {!! Form::text('pret', $local->pret, ['class' => 'form-control', 'aria-describedby' => 'error-updt']) !!}
                {!! $errors->first('pret', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has('accessibilite') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('accessibilite', 'Accessibilité', array('class' => 'control_label')) !!}
                {!! Form::textarea('accessibilite', $local->accessibilite, ['class' => 'form-control', 'aria-describedby' => 'error-updt', 'rows' => 3]) !!}
                {!! $errors->first('accessibilite', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {!! $errors->has('local_partage') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('local_partage', 'Local partagé', array('class' => 'control_label')) !!}
                {{ Form::select('local_partage', ['Non', 'Oui'], $local->local_partage,  ['class' => 'form-control', 'aria-describedby' => 'error-updt']) }}
                {!! $errors->first('local_partage', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has('precision_partage') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('precision_partage', 'Précision partage', array('class' => 'control_label')) !!}
                {!! Form::textarea('precision_partage', $local->precision_partage, ['class' => 'form-control', 'aria-describedby' => 'error-updt', 'rows' => 3]) !!}
                {!! $errors->first('precision_partage', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has('charge_bailleur') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('charge_bailleur', 'Charge bailleur', array('class' => 'control_label')) !!}
                {!! Form::textarea('charge_bailleur', $local->charge_bailleur, ['class' => 'form-control', 'aria-describedby' => 'error-updt', 'rows' => 3]) !!}
                {!! $errors->first('charge_bailleur', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has('charge_rdc') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('charge_rdc', 'Charge RDC', array('class' => 'control_label')) !!}
                {!! Form::textarea('charge_rdc', $local->charge_rdc, ['class' => 'form-control', 'aria-describedby' => 'error-updt', 'rows' => 3]) !!}
                {!! $errors->first('charge_rdc', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has('detail_charge') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('detail_charge', 'Détail charge', array('class' => 'control_label')) !!}
                {!! Form::textarea('detail_charge', $local->detail_charge, ['class' => 'form-control', 'aria-describedby' => 'error-updt', 'rows' => 3]) !!}
                {!! $errors->first('detail_charge', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has('observation_generale') ? 'has-error' : '' !!} has-feedback">
                {!! Form::label('observation_generale', 'Observation générale', array('class' => 'control_label')) !!}
                {!! Form::textarea('observation_generale', $local->observation_generale, ['class' => 'form-control', 'aria-describedby' => 'error-updt', 'rows' => 3]) !!}
                {!! $errors->first('observation_generale', '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                <span id="error-updt" class="sr-only">(error)</span><small class="help-block">:message</small>') !!}
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
        
    <div class="footer pull-right">
        @if($page == 'Locaux')
        <a href="{{ route('listeLocaux.index', [$page, $pageSmall]) }}" class="btn btn-default ">Annuler</a>
        @elseif($page == 'ACI' && $pageSmall == '>50RI')
        <a href="{{ route('listeACI.index', [$page, $pageSmall]) }}" class="btn btn-default ">Annuler</a>
        @elseif($page == 'ACI' && $pageSmall == 'RCPRO')
        <a href="{{ route('listeAciRCPRO.index', [$page, $pageSmall]) }}" class="btn btn-default ">Annuler</a>
        @elseif($page == 'Entrepots')
        <a href="{{ route('listeEntrepots.index', [$page, $pageSmall]) }}" class="btn btn-default ">Annuler</a>
        @elseif($page == 'AN')
        <a href="{{ route('listeBiensAN.index', [$page, $pageSmall]) }}" class="btn btn-default ">Annuler</a>
        @endif

        @if($local->id)
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