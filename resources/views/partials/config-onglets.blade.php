<div class="row">
	<form action="{{ route('filters', [$page, $pageSmall]) }}" method="GET">
		{{ csrf_field() }} 
        @if($page == 'Locaux' || $page == 'ACI' || $page == 'Entrepots' || $page == 'AN')
        <div class="col-md-3 form-group">
	        <select class="form-control btn-info search-typeStructure" name="type_structure">
	            <option selected class="filtre" value="">Filtrer par Structure</option>
	          @forelse( $structures as $structure )
	            <option value="{{ $structure->id }}">{{ $structure->type_structure }}</option>
	          @empty
              @endforelse
	        </select>
	    </div>
        @endif
		
		@if($page == 'Algecos')
	    <div class="col-md-3">
	    	<input id="search-ville-algeco" type="text" name="ville_algeco" class="form-control btn-info search-ville" placeholder="Rechercher par ville" value="">
	    </div>
	    @elseif($page == 'Vehicules' || $page == 'Sinistres' && $pageSmall == 'Véhicules')
	    <div class="col-md-3">
	    	<input id="search-immat" type="text" name="immat" class="form-control btn-info search-immat" placeholder="Rechercher par immat" value="">
	    </div>
	    @elseif($page == 'Sinistres' && $pageSmall == 'Mas')
	    <div class="col-md-3">
	    	<input id="search-ref" type="text" name="ref_macif" class="form-control btn-info search-ref" placeholder="Rechercher par référence Macif" value="">
	    </div>
	    <div class="col-md-3">
	    	<input id="search-villeSinistre" type="text" name="ville_sinistre" class="form-control btn-info search-villeSinistre" placeholder="Rechercher par ville du sinistre" value="">
	    </div>
	    @elseif($page == 'Evenements')
	    <div class="col-md-2">
	    	<input id="search-villeEvent" type="text" name="ville_event" class="form-control btn-info search-villeEvent" placeholder="Rechercher par ville" value="">
	    </div>
	    <div class="col-md-3">
	    	<input id="search-nomEvent" type="text" name="nom_event" class="form-control btn-info search-nomEvent" placeholder="Rechercher par nom de l'évènement" value="">
	    </div>
	    <div class="col-md-2 form-group">
	        <select class="form-control btn-info search-typeEvent" name="type_event">
	            <option selected class="filtre" value="">Filtrer par type</option>
	            <option value="Manif">Manif</option>
	          	<option value="Reunion">Réunion</option>
	        </select>
	    </div>
	    <div class="col-md-2 form-group">
	        <select class="form-control btn-info search-statutEvent" name="statut_event">
	            <option selected class="filtre" value="">Filtrer par statut</option>
	            <option value="1">Cloturé (1)</option>
	          	<option value="0">Non cloturé (0)</option>
	        </select>
	    </div>
	    @else
	    <div class="col-md-3">
	    	<input id="search-ville" type="text" name="ville_local" class="form-control btn-info search-ville" placeholder="Rechercher par ville" value="">
	    </div>
	    @endif

	    @if($page != 'Evenements')
        <div class="col-md-2">
            <input id="search-ad" type="text" name="numero_ad" class="form-control btn-info searchAd" placeholder="Rechercher par AD" value="">
        </div>
        @endif 

        <div class="col-md-1 form-group">
	        <button type="submit" class="btn btn-extia">Filtrer <i class="fa fa-search" aria-hidden="true"></i></button>
	    </div> 
	</form> 
   
    <div id="eraseFiltre" class="col-md-2 form-group">
        <a href="{{ route($routeName, [$page, $pageSmall]) }}" class="btn btn-extia">Effacer <i class="fa fa-eraser" aria-hidden="true"></i></a>
    </div>
</div>

<br>

<div class="row">
	@if( $page != 'Historique' )
    <div class="col-md-3 form-group">
        <button id="addColumn" type="button" class="btn btn-extia" data-toggle="modal" data-target="#myModalColumn">Paramétrage du tableau <span class="glyphicon glyphicon-flash" aria-hidden="true"></span></button>
    </div>
    <div class="col-md-2 form-group">
        <button id="choixExport" type="button" class="btn btn-extia" data-toggle="modal" data-target="#export-locaux">Exporter <span class="glyphicon glyphicon-export" aria-hidden="true"></span></span></button>
    </div>
    @else
    <div class="col-md-2 form-group">
    	<form action="{{ route('downloadExcel', [$page, $pageSmall, 'xls']) }}" method="POST">
    	{{csrf_field()}}
        	<button id="exportExcel" type="submit" class="btn btn-extia">Exporter (.xls) <span class="glyphicon glyphicon-export" aria-hidden="true"></span></button>
        </form>
    </div>
    @endif
</div>