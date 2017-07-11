@extends('layouts.admin')

@section('title', 'locaux')

@section('content')

<h1 class="page-header"><i class="fa fa-building"></i> {{$page}} <small>{{$pageSmall}}</small></h1>

<div class="row">
	<form action="{{ route('filters', [$page, $pageSmall]) }}" method="GET">

        <div class="col-md-3 form-group">
	        <select class="form-control btn-info search-typeStructure" name="type_structure">
	            <option selected class="filtre" value="">Filtrer par Structure</option>
	          @forelse( $structures as $structure )
	            <option value="{{ $structure->type_structure }}">{{ $structure->type_structure }}</option>
	          @empty
              @endforelse
	        </select>
	    </div>
	
	    <div class="col-md-3">
	    	<input id="search-ville" type="text" name="ville_local" class="form-control btn-info search-ville" placeholder="Rechercher par ville" value="">
	    </div>

        <div class="col-md-2">
            <input id="search-ad" type="text" name="numero_ad" class="form-control btn-info searchAd" placeholder="Rechercher par AD" value="">
        </div>
	   
	    <div class="col-md-2 form-group">
	        <button type="submit" class="btn btn-extia">Filtrer <i class="fa fa-search" aria-hidden="true"></i></button>
	    </div>
	</form> 
   

    <div id="eraseFiltre" class="col-md-2 form-group">
        <a href="{{ route($routeName, [$page, $pageSmall]) }}" class="btn btn-extia">Effacer <i class="fa fa-eraser" aria-hidden="true"></i></a>
    </div>
</div>

<br>

<div class="row">
    <div class="col-md-3 form-group">
        <button id="addColumn" type="button" class="btn btn-extia" data-toggle="modal" data-target="#myModalColumn">Paramétrage du tableau <span class="glyphicon glyphicon-flash" aria-hidden="true"></span></button>
    </div>
    <div class="col-md-2 form-group">
        <button id="choixExport" type="button" class="btn btn-extia" data-toggle="modal" data-target="#export-locaux">Exporter <span class="glyphicon glyphicon-export" aria-hidden="true"></span></span></button>
    </div>
</div>

<br>

<div class="overflow">
	<table id="locauxInf25" class="table table-striped table-hover locauxDestAll">
	    <thead>
	        <tr>
	        	@forelse($champsFinal as $c)
	        	<th>{{ $c->new_name}}</th>
	        	@empty
                @endforelse
	        	<th>Bail</th>
	        	<th>Actions</th>
	        </tr>	
	    </thead>
	    <tbody>
            @forelse($locauxStructures as $local)
	        <tr>
	        	@forelse($champsFinal as $c)
	        	<td>{{ $local[$c->old_name] }}</td>
				@empty
                @endforelse
	            <td>
	            	<button id="bail-{{$local->bail_id}}" type="button" class="btn btn-extia bail" data-toggle="modal" data-target="#bail" data-id="{{ $local->bail_id }}" data-tok="{{ csrf_token() }}" data-url="{{ route('bail.show', $local->bail_id) }}">Bail <i class="fa fa-eye"></i></button>
	            </td>
	            <td>
                    @if($page == 'Locaux')
	                <a class="btn btn-extia question-badge edition-badge" href="{{ route('listeLocaux.edit', [$page, $pageSmall, $local->local_id])}}" value="" ><i class="fa fa-pencil-square-o"></i></a>
                    <a href="" class="btn btn-extia delete-data" data-url="{!! route('listeLocaux.destroy', [$page, $pageSmall, $local->local_id]) !!}" data-toggle="modal" data-target="#supLocal""><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    @endif
                    @if($page == 'ACI')
                    <a class="btn btn-extia question-badge edition-badge" href="{{ route('listeACI.edit', [$page, $pageSmall, $local->local_id])}}" value="" ><i class="fa fa-pencil-square-o"></i></a>
                    <a href="" class="btn btn-extia delete-data" data-url="{!! route('listeACI.destroy', [$page, $pageSmall, $local->local_id]) !!}" data-toggle="modal" data-target="#supLocal""><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    @endif
	            </td>
	        </tr>
            @empty
	        @endforelse
	    </tbody>
	</table>
</div>

@isset($local)
<!-- Modal pour ajout/suppression des colonnes du tableau -->
<div class="modal fade" id="myModalColumn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    
    <form action="{{ route('updateColumns', [$page, $pageSmall]) }}" method="POST">
	{{csrf_field()}}
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="myModalLabel"><i class="fa fa-table" aria-hidden="true"></i> Ajouter/supprimer des colonnes</h2>
      </div>
      <div class="modal-body">
			<div class="row">
                @forelse($champs->chunk(10) as $chunk)
                <div class="col-md-3">
					<table id="choix-colonnes">
                        @forelse($chunk as $champ)
						<tr>
							<td id="">{{ $champ->new_name}} </td>
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
            <div class="row">
                @forelse($champs->chunk(10) as $chunk)
                <div class="col-md-3">
                    <table id="choix-colonnes">
                        @forelse($chunk as $champ)
                        <tr>
                            <td id="">{{ $champ->new_name}} </td>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button id="exportExcel" type="submit" class="btn btn-extia">Exporter (.xls) <span class="glyphicon glyphicon-export" aria-hidden="true"></span></button>
      </div>
     </form>
    </div>
  </div>
</div>

<!-- Modal pour vue/edition des baux -->
<div class="modal fade" id="bail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    
    <form id="bail_update" action="{{ route('bail.update', $local->bail_id)}}">
	{{ csrf_field() }} 
    {{ method_field('PUT') }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="myModalLabel"><i class="fa fa-table" aria-hidden="true"></i> Bail associé au local</h2>
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

<!-- Modal surpression local -->
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

                <div class="modal-body">
                    <p class="huge2"> <b>Etes vous sure de vouloir supprimer ce local?</b> </p>

                    <div class="form-inline">
                        <p>Si oui, veuillez indiquer la <b>date de résiliation effective</b> : <input type="date" name="date_resiliation" class="form-control"></p>
                    </div>
                    <div class="form-group">
                        <p><b>Motif de la résiliation</b> : <textarea name="motif" class="form-control" rows="3"></textarea></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Annuler</button>
                    <button id="delete-btn" type="submit" class="btn btn-extia">Supprimer</button>
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