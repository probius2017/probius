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
    <li{!! isset($page) && $page == '' ? ' class="active"' : '' !!}>
        <a href="#"><i class="fa fa-building"></i> ACI <span class="small">(RC PRO)</span></a>
    </li>
    <li{!! isset($page) && $page == '' ? ' class="active"' : '' !!}>
        <a href="#"><i class="fa fa-building"></i> Entrepots <span class="small">(&gt;25RI)</span></a>
    </li>
    <li{!! isset($page) && $page == '' ? ' class="active"' : '' !!}>
        <a href="#"><i class="fa fa-building"></i> Algécos</a>
    </li>
    <li{!! isset($page) && $page == '' ? ' class="active"' : '' !!}>
        <a href="#"><i class="fa fa-building"></i> Chambres froides</a>
    </li>
    <li{!! isset($page) && $page == '' ? ' class="active"' : '' !!}>
        <a href="#"><i class="fa fa-bed"></i> Logements</a>
    </li>
    <li{!! isset($page) && $page == '' ? ' class="active"' : '' !!}>
        <a href="#"><i class="fa fa-building-o"></i> Biens AN</a>
    </li>
    <li{!! isset($page) && $page == '' ? ' class="active"' : '' !!}>
        <a href="#"><i class="fa fa-car"></i> Véhicules</a>
    </li>
    <li{!! isset($page) && $page == '' ? ' class="active"' : '' !!}>
        <a href="#"><i class="fa fa-calendar"></i> Evènements</a>
    </li>
    <li{!! isset($page) && $page == '' ? ' class="active"' : '' !!}>
        <a href="#"><i class="fa fa-exclamation-triangle"></i> Sinistres masse</a>
    </li>
    <li{!! isset($page) && $page == '' ? ' class="active"' : '' !!}>
        <a href="#"><i class="fa fa-exclamation-triangle"></i> Sinistres véhicules</a>
    </li>
</ul>
