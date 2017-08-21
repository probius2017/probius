<div class="row">
	<form action="{{ route('filters', [$page, $pageSmall]) }}" method="GET">
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
	    @else
	    <div class="col-md-3">
	    	<input id="search-ville" type="text" name="ville_local" class="form-control btn-info search-ville" placeholder="Rechercher par ville" value="">
	    </div>
	    @endif

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
	@if( $page != 'Historique' )
    <div class="col-md-3 form-group">
        <button id="addColumn" type="button" class="btn btn-extia" data-toggle="modal" data-target="#myModalColumn">Paramétrage du tableau <span class="glyphicon glyphicon-flash" aria-hidden="true"></span></button>
    </div>
    <div class="col-md-2 form-group">
        <button id="choixExport" type="button" class="btn btn-extia" data-toggle="modal" data-target="#export-locaux">Exporter <span class="glyphicon glyphicon-export" aria-hidden="true"></span></span></button>
    </div>
    @else
    <div class="col-md-2 form-group">
    	<form action="{{ URL::to('admin/downloadExcel/xls') }}" method="POST">
    	{{csrf_field()}}
        	<button id="exportExcel" type="submit" class="btn btn-extia">Exporter (.xls) <span class="glyphicon glyphicon-export" aria-hidden="true"></span></button>
        </form>
    </div>
    @endif
</div>