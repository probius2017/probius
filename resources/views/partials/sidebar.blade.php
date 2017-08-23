<ul class="nav nav-sidebar">
	<li{!! isset($page) && $page == 'home' ? ' class="active"' : '' !!}>
        <a href="{!! route('home') !!}"><i class="fa fa-home" aria-hidden="true"></i> Accueil</a>
    </li>
</ul>

<ul class="nav nav-sidebar">
    <li{!! isset($page) && $page == 'Locaux' ? ' class="active"' : '' !!}>
        <a href="{{ route('listeLocaux.index', ['Locaux', '&lt;25RI']) }}" data-toggle="collapse" data-target="#loc1"><i class="fa fa-building"></i> Locaux <span class="small">(&lt;25RI)</span><!-- <i class="fa fa-fw fa-caret-down"></i> --></a>
        	<!-- <ul id="loc1" class="collapse">
        		<li><a href="#"><i class="fa fa-share" aria-hidden="true"></i> Exporter</a></li>
        	</ul> -->
    </li>
    <li{!! isset($page) && $page == 'ACI' && $pageSmall == '>50RI' ? ' class="active"' : '' !!}>
        <a href="{{ route('listeACI.index', ['ACI', '&gt;50RI']) }}"><i class="fa fa-building"></i> ACI <span class="small">(&gt;50RI)</span></a>
    </li>
    <li{!! isset($page) && $page == 'ACI' && $pageSmall == 'RCPRO' ? ' class="active"' : '' !!}>
        <a href="{{ route('listeAciRCPRO.index', ['ACI', 'RCPRO']) }}"><i class="fa fa-building"></i> ACI <span class="small">(RC PRO)</span></a>
    </li>
    <li{!! isset($page) && $page == 'Entrepots' ? ' class="active"' : '' !!}>
        <a href="{{ route('listeEntrepots.index', ['Entrepots', '>25RI']) }}"><i class="fa fa-building"></i> Entrepots <span class="small">(&gt;25RI)</span></a>
    </li>
    <li{!! isset($page) && $page == 'Algecos' ? ' class="active"' : '' !!}>
        <a href="{{ route('listeAlgecos.index', ['Algecos', ' ']) }}"><i class="fa fa-building"></i> Algécos</a>
    </li>
    <li{!! isset($page) && $page == 'Chambres-froides' ? ' class="active"' : '' !!}>
        <a href="{{ route('listeChambresFroides.index', ['Chambres-froides', ' ']) }}"><i class="fa fa-snowflake-o" aria-hidden="true"></i> Chambres froides</a>
    </li>
    <li{!! isset($page) && $page == '' ? ' class="active"' : '' !!}>
        <a href="#"><i class="fa fa-bed"></i> Logements</a>
    </li>
    <li{!! isset($page) && $page == 'AN' ? ' class="active"' : '' !!}>
        <a href="{{ route('listeBiensAN.index', ['AN', 'Biens']) }}"><i class="fa fa-building-o"></i> Biens AN</a>
    </li>
    <li{!! isset($page) && $page == 'Vehicules' ? ' class="active"' : '' !!}>
        <a href="{{ route('listeVehicules.index', ['Vehicules', ' ']) }}"><i class="fa fa-car"></i> Véhicules</a>
    </li>
    <li{!! isset($page) && $page == 'Evenements' ? ' class="active"' : '' !!}>
        <a href=""><i class="fa fa-calendar"></i> Evènements</a>
    </li>
    <li{!! isset($page) && $page == 'Sinistres' && $pageSmall == 'Masse' ? ' class="active"' : '' !!}>
        <a href="{{ route('listeSinistresMasse.index', ['Sinistres', 'Masse']) }}"><i class="fa fa-exclamation-triangle"></i> Sinistres masse</a>
    </li>
    <li{!! isset($page) && $page == 'Sinistres' && $pageSmall == 'Véhicules' ? ' class="active"' : '' !!}>
        <a href="{{ route('listeSinistresVehicules.index', ['Sinistres', 'Véhicules']) }}"><i class="fa fa-exclamation-triangle"></i> Sinistres véhicules</a>
    </li>
</ul>
