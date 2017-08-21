<div id="header">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand flex-logo" href="{{ route('home') }}"><img src="{{ asset('assets/img/rdc-logo.png') }}" alt="logo rdc" width="25" height="25"><p class="navbar-text"><span class="logo-1">Prob</span><span class="logo-2">Ius</span></p></a>
            </div>
            @if(Auth::check())
                <ul class="nav navbar-nav navbar-n">
                    <li{!! isset($page) && $page == 'flux' ? ' class="active"' : '' !!}>
                        <a href="#"><i class="fa fa-file-text"></i> Flux d'activités</a>
                    </li>

                    <li{!! isset($page) && $page == 'Historique' ? ' class="active"' : '' !!}>
                        <a  href="#" id="dropHisto" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-history" aria-hidden="true"></i> Historiques <span class="caret"></span></a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="{{ route('historiqueLocaux', ['Historique', 'Locaux']) }}"><i class="fa fa-eye" aria-hidden="true"></i> Historique locaux</a></li>
                                <li><a href="{{ route('historiqueVehicules', ['Historique', 'véhicules']) }}"><i class="fa fa-eye" aria-hidden="true"></i> historique véhicules</a></li>
                            </ul>
                    </li>

                    <li{!! isset($page) && $page == 'createLocal' ? ' class="active"' : '' !!}>
                        <a href="{{ route('createLocal') }}"><i class="fa fa-plus"></i> Ajouter un Local</a>
                    </li>
                    <!-- <li{!! isset($page) && $page == 'createChambreF' ? ' class="active"' : '' !!}>
                        <a href=""><i class="fa fa-plus"></i> Ajouter une Chambre froide</a>
                    </li>
                    <li{!! isset($page) && $page == 'createAlgeco' ? ' class="active"' : '' !!}>
                        <a href=""><i class="fa fa-plus"></i> Ajouter un Algéco</a>
                    </li>
                    <li{!! isset($page) && $page == 'createLogement' ? ' class="active"' : '' !!}>
                        <a href=""><i class="fa fa-plus"></i> Ajouter un Logement</a>
                    </li> -->
                </ul>

                <div class="collapse navbar-collapse navbar-right">
                    <button class="btn btn-default navbar-btn dropdown-toggle" type="button" id="drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-unlock-alt"></i> {{ Auth::user()->login }} <span class="caret"></span></button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i> Créer un Admin</a></li>
                            <li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i> Supprimer un Admin</a></li>
                        </ul>

                    <a href="{{ route('logout') }}" class="btn btn-default navbar-btn "><i class="fa fa-power-off" title="Déconnection"></i></a>
                </div>
            @endif
        </div>
    </nav>
</div>

