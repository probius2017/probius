@extends('layouts.admin')

@section('title', 'locaux')

@section('content')

<h1 class="page-header"><i class="fa fa-building"></i> {{$page}} <small>{{$pageSmall}}</small></h1>

@include('partials.config-onglets')

<br>

<div class="overflow">
	<table id="locauxInf25" class="table table-striped table-hover locauxDestAll">
	    <thead>
	        <tr>
                <th>Ad</th>

	        	@forelse($champsFinal as $c)
	        	<th>{{ $c->new_name}}</th>
	        	@empty
                @endforelse
                
                @if($page == 'Chambres-froides')
                <th>Nb Chambre froide</th>
                <th>Volume (m3)</th>
                @elseif($page == 'Algecos')
                <th>Bail</th>
                @else
                <th>Structure(s)</th>
                <th>Bail</th>
                @endif
  
	        	<th>Actions</th>
	        </tr>	
	    </thead>
	    <tbody>
        @forelse($locaux as $local)

            @if($page == 'Chambres-froides')
            <tr>
                <td>{{ $local->ad->numero_ad }}</td>

                @forelse($champsFinal as $c)
                    @if($c->table_name == 'locaux')
                        <td>{{ $local[$c->old_name] }}</td>
                    @elseif($c->table_name == 'contrats')
                        <td>
                            @foreach($local->contrats->where('num_contrat', '9453062') as $contrat)
                            <p>{{ $contrat[$c->old_name] }}</p>
                            @endforeach
                        </td>
                    @endif
                @empty
                @endforelse  
                <td>{{ $local->chambresFroides->count() }}</td>
                <td>
                    @forelse($local->chambresFroides as $cf)
                    <span>{{ $cf->volume }}</span><br><br>
                    @empty
                    @endforelse
                </td>
                <td>
                    @forelse($local->chambresFroides as $cf)
                    <a class="question-badge edition-badge edit-cf" href="" data-url="{{ route('listeChambresFroides.update', [$page, $pageSmall, $cf->id]) }}" data-volume="{{ $cf->volume }}" data-toggle="modal" data-target="#editCF"><i class="fa fa-pencil-square-o"></i></a>
                    <a href="" class="btn-extia delete-data CF-dlt" data-url="{!! route('listeChambresFroides.destroy', [$page, $pageSmall, $cf->id]) !!}" data-toggle="modal" data-target="#supLocal"><i class="fa fa-trash-o" aria-hidden="true"></i></a><br><br>
                    @empty
                    @endforelse
                </td> 
	        </tr>
            @elseif($page == 'Algecos')
            <tr>
                <td>{{ $local->ad->numero_ad }}</td>

                @forelse($champsFinal as $c)
                    @if($c->table_name == 'algecos')
                        <td>{{ $local[$c->old_name] }}</td>
                    @elseif($c->table_name == 'locaux')
                        <td>{{ $local[$c->old_name] }}</td>
                    @elseif($c->table_name == 'contrats')
                        <td>
                            @foreach($local->contrats->where('num_contrat', '9453755') as $contrat)
                            <p>{{ $contrat[$c->old_name] }}</p>
                            @endforeach
                        </td>
                    @endif
                @empty
                @endforelse  
                
                <td>
                    <button id="bail-{{$local->bail_id}}" type="button" class="btn btn-extia bail" data-toggle="modal" data-target="#bail" data-id="{{ $local->bail_id }}" data-tok="{{ csrf_token() }}" data-url="{{ route('bail.show', $local->bail_id) }}">Bail <i class="fa fa-eye"></i></button>
                </td>
                <td>
                    <a class="btn btn-extia question-badge edition-badge" href="{{ route('listeAlgecos.edit', [$page, $pageSmall, $local->id])}}" value="" ><i class="fa fa-pencil-square-o"></i></a>
                    <a href="" class="btn btn-extia delete-data" data-url="{!! route('listeAlgecos.destroy', [$page, $pageSmall, $local->id]) !!}" data-toggle="modal" data-target="#supLocal""><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                </td>
            </tr>
            @else
            <tr>
                <td>{{ $local->ad->numero_ad }}</td>
                @forelse($champsFinal as $c)
                    @if($c->table_name == 'locaux')
                      <td>{{ $local[$c->old_name] }}</td>
                    @elseif($c->table_name == 'baux')
                      @if($c->old_name == 'date_debut' || $c->old_name == 'date_signature' || $c->old_name == 'date_fin')
                      <td>{{ $local->bail[$c->old_name]->format('d/m/Y') }}</td>
                      @else
                      <td>{{ $local->bail[$c->old_name] }}</td>
                      @endif
                    @elseif($c->table_name == 'contrats')
                        @if($pageSmall == '>50RI')
                            <td>
                                @foreach($local->contrats->where('num_contrat', '9322933') as $contrat)
                                <p>{{ $contrat[$c->old_name] }}</p>
                                @endforeach
                            </td>
                        @elseif($pageSmall == 'RCPRO')
                            <td>
                                @foreach($local->contrats->where('num_contrat', '971 0000 94067 F 50') as $contrat)
                                <p>{{ $contrat[$c->old_name] }}</p>
                                @endforeach
                            </td>
                        @elseif($page == 'Entrepots')
                            <td>
                                @foreach($local->contrats->where('num_contrat', '9453148') as $contrat)
                                <p>{{ $contrat[$c->old_name] }}</p>
                                @endforeach
                            </td>
                        @elseif($page == 'AN')
                            <td>
                                @foreach($local->contrats->where('num_contrat', '6665737') as $contrat)
                                <p>{{ $contrat[$c->old_name] }}</p>
                                @endforeach
                            </td>
                        @endif
                    @endif
                @empty
                @endforelse  
                <td>
                    @forelse($local->structures as $struc)
                        <span class="badge btn-cat">
                          {{ $struc->type_structure }}
                        </span>
                    @empty
                    @endforelse
                </td>
                <td>
                    <button id="bail-{{$local->bail_id}}" type="button" class="btn btn-extia bail" data-toggle="modal" data-target="#bail" data-id="{{ $local->bail_id }}" data-tok="{{ csrf_token() }}" data-url="{{ route('bail.show', $local->bail_id) }}">Bail <i class="fa fa-eye"></i></button>
                </td>
                <td>
                    @if($page == 'Locaux')
                    <a class="btn btn-extia question-badge edition-badge" href="{{ route('listeLocaux.edit', [$page, $pageSmall, $local->id])}}" value="" ><i class="fa fa-pencil-square-o"></i></a>
                    <a href="" class="btn btn-extia delete-data" data-url="{!! route('listeLocaux.destroy', [$page, $pageSmall, $local->id]) !!}" data-toggle="modal" data-target="#supLocal""><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    @endif
                    @if($page == 'ACI' && $pageSmall == '>50RI')
                    <a class="btn btn-extia question-badge edition-badge" href="{{ route('listeACI.edit', [$page, $pageSmall, $local->id])}}" value="" ><i class="fa fa-pencil-square-o"></i></a>
                    <a href="" class="btn btn-extia delete-data" data-url="{!! route('listeACI.destroy', [$page, $pageSmall, $local->id]) !!}" data-toggle="modal" data-target="#supLocal""><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    @endif
                    @if($page == 'ACI' && $pageSmall == 'RCPRO')
                    <a class="btn btn-extia question-badge edition-badge" href="{{ route('listeAciRCPRO.edit', [$page, $pageSmall, $local->id])}}" value="" ><i class="fa fa-pencil-square-o"></i></a>
                    <a href="" class="btn btn-extia delete-data" data-url="{!! route('listeAciRCPRO.destroy', [$page, $pageSmall, $local->id]) !!}" data-toggle="modal" data-target="#supLocal""><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    @endif
                    @if($page == 'Entrepots')
                    <a class="btn btn-extia question-badge edition-badge" href="{{ route('listeEntrepots.edit', [$page, $pageSmall, $local->id])}}" value="" ><i class="fa fa-pencil-square-o"></i></a>
                    <a href="" class="btn btn-extia delete-data" data-url="{!! route('listeEntrepots.destroy', [$page, $pageSmall, $local->id]) !!}" data-toggle="modal" data-target="#supLocal""><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    @endif
                    @if($page == 'AN')
                    <a class="btn btn-extia question-badge edition-badge" href="{{ route('listeBiensAN.edit', [$page, $pageSmall, $local->id])}}" value="" ><i class="fa fa-pencil-square-o"></i></a>
                    <a href="" class="btn btn-extia delete-data" data-url="{!! route('listeBiensAN.destroy', [$page, $pageSmall, $local->id]) !!}" data-toggle="modal" data-target="#supLocal""><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    @endif
                </td>
            </tr>
            @endif

        @empty
        @endforelse
	    </tbody>
	</table>
</div>

<!-- Modal pour ajout/suppression des colonnes du tableau -->
<div class="modal fade" id="myModalColumn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    
    <form id="form-colonnes" action="{{ route('updateColumns', [$page, $pageSmall]) }}" method="POST">
	{{csrf_field()}}
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="myModalLabel"><i class="fa fa-table" aria-hidden="true"></i> Ajouter/supprimer des colonnes</h2>
      </div>
      <div class="modal-body">
			<div class="row choix-colonnes">
                @forelse($champs->chunk(10) as $chunk)
                <div class="col-md-3">
					<table>
                        @forelse($chunk as $champ)
						<tr>
							<td>{{ $champ->new_name}} </td>
							<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td>
                                <input id="{{ $champ->new_name }}" type="checkbox" name="columns[]" value="{{ $champ->old_name }}" {{ $champ->status == 1 ? 'checked' : ''}}/>
							</td>
						</tr>
    					@empty
            			@endforelse
					</table>
                </div>
                @empty
                @endforelse
			</div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group checkAllCol">
                      {!! Form::label('checkAllCol', 'Ajouter toutes les colonnes au tableau ?', array('class' => 'control_label')) !!}
                      {!! Form::checkbox('checkAllCol') !!}
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button id="addColumns" type="submit" class="btn btn-extia">Valider <i class="fa fa-check"></i></button>
      </div>

     </form>
    </div>
  </div>
</div>

<!-- Modal pour choix colonnes export-->
<div class="modal fade" id="export-locaux" tabindex="-1" role="dialog" aria-labelledby="export-locaux">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    
    <form action="{{ URL::to('admin/downloadExcel/xls') }}" method="POST">
    {{csrf_field()}}
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="myModalLabel"><i class="fa fa-table" aria-hidden="true"></i> Choix des colonnes pour l'export</h2>
      </div>
      <div class="modal-body">
            <div class="row choix-colonnes2">
                @forelse($champs->chunk(10) as $chunk)
                <div class="col-md-3">
                    <table>
                        @forelse($chunk as $champ)
                        <tr>
                            <td>{{ $champ->new_name}} </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td>
                                <input id="{{ $champ->new_name }}" type="checkbox" name="columns[]" value="{{ $champ->old_name }}" {{ $champ->status == 1 ? 'checked' : ''}}/>
                                <input type="hidden" name="status[]" value="{{ $champ->status}}">
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </table>
                </div>
                @empty
                @endforelse
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group checkAllExp">
                      {!! Form::label('checkAllExp', 'Exporter toutes les colonnes ?', array('class' => 'control_label')) !!}
                      {!! Form::checkbox('checkAllExp') !!}
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button id="exportExcel" type="submit" class="btn btn-extia">Exporter (.xls) <span class="glyphicon glyphicon-export" aria-hidden="true"></span></button>
      </div>
     </form>
    </div>
  </div>
</div>

@isset($local)
<!-- Modal pour vue/edition des baux -->
<div class="modal fade" id="bail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    
    <form id="bail_update" action="{{ route('bail.update', $local->bail_id)}}">
	{{ csrf_field() }} 
    {{ method_field('PUT') }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        @if($page != 'Algecos' )
        <h2 class="modal-title" id="myModalLabel"><i class="fa fa-table" aria-hidden="true"></i> Bail associé à ce Local</h2>
        @else
        <h2 class="modal-title" id="myModalLabel"><i class="fa fa-table" aria-hidden="true"></i> Bail associé à cet Algéco</h2>
        @endif
      </div>
      <div class="modal-body">
	      <div class="row add-data-bail">
            <!-- partie js ppour remplir les données du bail-->
	      </div>
      </div>
      <div class="modal-footer">
        <button id="close-bail" type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-extia" disabled="">Editer</button>
      </div>

     </form>
    </div>
  </div>
</div>

<!-- Modal surpression local / Algéco / chambre froide -->
<div class="modal fade" id="supLocal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel2">
                    <i class="fa fa-times"></i>
                    Suppression
                </h4>
            </div>
            <form id="delete-form" action="" method="POST">
                <input type="hidden" name="_method" value="DELETE">

                <input id="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">

                @if($page == 'Algecos')
                <div class="modal-body">
                    <p class="huge2"> <b>Etes vous sure de vouloir supprimer cet algéco ?</b> </p>
                </div>
                @elseif($page == 'Chambres-froides')
                <div class="modal-body">
                    <p class="huge2"> <b>Etes vous sure de vouloir supprimer cette chambre froide ?</b> </p>
                </div>
                @else
                <div class="modal-body">
                    <p class="huge2"> <b>Etes vous sure de vouloir supprimer ce local?</b> </p>

                    <div class="form-inline">
                        <p>Si oui, veuillez indiquer la <b>date de résiliation effective</b> : <input type="date" name="date_resiliation" class="form-control"></p>
                    </div>
                    <div class="form-group">
                        <p><b>Motif de la résiliation</b> : <textarea name="motif" class="form-control" rows="3"></textarea></p>
                    </div>
                </div>
                @endif
                <div class="modal-footer">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Annuler</button>
                    <button id="delete-btn" type="submit" class="btn btn-extia">Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edition chambre froide -->
<div class="modal fade" id="editCF" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel2">
                    <i class="fa fa-pencil-square-o"></i>
                    Edition de la chambre froide
                </h4>
            </div>
            <form id="edit-form-cf" action="" method="POST">
                {{ csrf_field() }} 
                {{ method_field('PUT') }}

                <div class="modal-body">

                    <div class="form-inline">
                        <p>Modifier la valeur du <b>Volume</b> de la chambre froide : <input type="text" name="volume" class="form-control volume"></p>
                    </div>
                </div>
          

                <div class="modal-footer">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Annuler</button>
                    <button id="" type="submit" class="btn btn-extia">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endisset

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