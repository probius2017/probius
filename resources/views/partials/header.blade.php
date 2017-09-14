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
                            <li><a href="{{ route('historiqueVehicules', ['Historique', 'véhicules']) }}"><i class="fa fa-eye" aria-hidden="true"></i> Historique véhicules</a></li>
                        </ul>
                    </li>
                    <li{!! isset($page) && $page == 'createEntity' ? ' class="active"' : '' !!}>
                        <a  href="" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-plus" aria-hidden="true"></i> Créer une entité <span class="caret"></span></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

                            <!-- <table class="table dropdown-menu" aria-labelledby="dropdownMenu1">
                                <tbody class="create-entity">
                                    <tr><a href="#">
                                        <td><i class="fa fa-building" aria-hidden="true"></i></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>Local</td>
                                        </a>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-snowflake-o" aria-hidden="true"></i></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>Chambre froide</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-building-o" aria-hidden="true"></i></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>Algéco</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-bed" aria-hidden="true"></i></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>Logement</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-car" aria-hidden="true"></i></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>Véhicule</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>Sinistre</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;</td>
                                        <td>Mas</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;</td>
                                        <td>Véhicule</td>
                                    </tr>
                                </tbody>
                            </table> -->

                            <li><a href="{{ route('createLocal', ['createEntity', 'Local']) }}" class="test-flex"><i class="fa fa-building" aria-hidden="true"></i> Local</a></li>
                            <li><a href="#"><i class="fa fa-snowflake-o" aria-hidden="true"></i> Chambre froide</a></li>
                            <li><a href="#"><i class="fa fa-building-o" aria-hidden="true"></i> Algéco</a></li>
                            <li><a href="#"><i class="fa fa-bed" aria-hidden="true"></i> Logement</a></li>
                            <li><a href="#"><i class="fa fa-car" aria-hidden="true"></i> Véhicule</a></li>
                            <li>
                                <a href="#"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Sinistre</a>
                                <ul>
                                    <li><a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> Mas</a></li>
                                    <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i> Véhicule</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
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

