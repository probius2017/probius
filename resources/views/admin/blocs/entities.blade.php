@extends('layouts.admin')

@section('title', 'locaux')

@section('content')

    <h1 class="page-header">
        @if($page == 'Chambres-froides')
            <i class="fa fa-snowflake-o"></i>
        @elseif($pageSmall == 'Biens')
            <i class="fa fa-building-o"></i>
        @elseif($page == 'Vehicules')
            <i class="fa fa-car"></i>
        @elseif($page == 'Evenements')
            <i class="fa fa-calendar"></i>
        @elseif($page == 'Sinistres')
            <i class="fa fa-exclamation-triangle"></i>
        @else
            <i class="fa fa-building"></i>
        @endif
        {{$page}}
        <small>{{$pageSmall}}</small>
    </h1>

    @include('partials.config-onglets')

    <br>

    <div>
        <table id="locauxInf25" class="table table-hover locauxDestAll overflow-x pre-scrollable">
            <thead>
            <tr>
                @if($page != 'Evenements')
                    <th>Ad</th>
                @else
                    <th>#</th>
                @endif

                @forelse($champsFinal as $c)
                    <th>{{ $c->new_name}}</th>
                @empty
                @endforelse

                @if($page == 'Chambres-froides')
                    <th>Nb Chambre froide</th>
                    <th>Volume (m3)</th>
                @elseif($page == 'Algecos')
                    <th>Bail</th>
                @elseif($page == 'Vehicules')
                @elseif($page == 'Evenements')
                @elseif($page == 'Sinistres')
                @else
                    <th>Structure(s)</th>
                    <th>Nb Ch.froide</th>
                    <th>Bail</th>
                @endif

                <th>Action(s)</th>
            </tr>
            </thead>
            <tbody class="recupIdForExport ">
            @forelse($entities as $entity)

                @if($page == 'Chambres-froides')
                    <tr>
                        <td class="flex-vol"><p>{{ $entity->ad->numero_ad }}</p></td>

                        @forelse($champsFinal as $c)
                            @if($c->table_name == 'locaux')
                                <td class="flex-vol"><p>{{ $entity[$c->old_name] }}</p></td>
                            @elseif($c->table_name == 'contrats')
                                <td class="flex-vol">
                                    @foreach($entity->contrats->where('num_contrat', '9453062') as $contrat)
                                        <p>{{ $contrat[$c->old_name] }}</p>
                                    @endforeach
                                </td>
                            @endif
                        @empty
                        @endforelse
                        <td class="flex-vol"><p>{{ $entity->chambresFroides->where('date_delete', null)->count() }}</p>
                        </td>


                        <td class="flex-vol">
                            @forelse($entity->chambresFroides as $cf)
                                @if($cf->date_delete == null)
                                    <span class="voldim">{{ $cf->volume }}</span>
                                @endif
                            @empty
                            @endforelse
                        </td>
                        <td>
                            @forelse($entity->chambresFroides as $cf)
                                @if($cf->date_delete == null)
                                    <div class="btn-top-bottom">
                                        <a class="btn btn-extia question-badge edition-badge edit-cf" href="#"
                                           data-url="{{ route('listeChambresFroides.update', [$page, $pageSmall, $cf->id]) }}"
                                           data-volume="{{ $cf->volume }}" data-id="{{ $entity->id }}"
                                           data-toggle="modal"
                                           data-target="#editCF"><i class="fa fa-pencil-square-o"></i></a>
                                        @forelse($entity->contrats->where('num_contrat', '9453062') as $c)
                                            <a href="#" class="btn btn-extia delete-data suppression"
                                               data-sinistres="{{ $entity->sinistres->where('date_cloture', null)->where('contrat_id', $c->id)->count() }}"
                                               data-url="{!! route('listeChambresFroides.destroy', [$page, $pageSmall, $cf->id]) !!}"
                                               data-toggle="modal" data-target="#supLocal"><i class="fa fa-trash-o"
                                                                                              aria-hidden="true"></i></a>
                                    </div>
                                    @empty
                                    @endforelse
                                @endif
                            @empty
                            @endforelse

                        </td>
                        @if($entity->sinistres->isNotEmpty())
                            <td>
                                <button type="button" class="btn btn-extia sinistres" data-toggle="modal"
                                        data-target="#sinistre" data-id="{{ $entity->id }}"
                                        data-tok="{{ csrf_token() }}"
                                        data-url="{{ route('listeRefSinistresByEntity', [$page, $pageSmall, $entity->id]) }}">
                                    <i class="fa fa-exclamation-triangle"></i></button>
                            </td>
                        @endif
                    </tr>
                @elseif($page == 'Algecos')
                    <tr>
                        <td>{{ $entity->ad->numero_ad }}</td>

                        @forelse($champsFinal as $c)
                            @if($c->table_name == 'algecos')
                                <td>{{ $entity[$c->old_name] }}</td>
                            @elseif($c->table_name == 'locaux')
                                <td>{{ $entity[$c->old_name] }}</td>
                            @elseif($c->table_name == 'contrats')
                                <td>
                                    @foreach($entity->contrats->where('num_contrat', '9453755') as $contrat)
                                        <p>{{ $contrat[$c->old_name] }}</p>
                                    @endforeach
                                </td>
                            @endif
                        @empty
                        @endforelse

                        <td>
                            <button id="bail-{{$entity->bail_id}}" type="button" class="btn btn-extia bail"
                                    data-toggle="modal" data-target="#bail" data-id="{{ $entity->bail_id }}"
                                    data-tok="{{ csrf_token() }}" data-url="{{ route('bail.show', $entity->bail_id) }}">
                                Bail <i class="fa fa-eye"></i></button>
                        </td>
                        <td>
                            <a class="btn btn-extia question-badge edition-badge"
                               href="{{ route('listeAlgecos.edit', [$page, $pageSmall, $entity->id])}}"
                               data-id="{{ $entity->id }}" value=""><i class="fa fa-pencil-square-o"></i></a>
                            <a href="" class="btn btn-extia delete-data"
                               data-sinistres="{{ $entity->sinistres->where('date_cloture', null)->count() }}"
                               data-url="{!! route('listeAlgecos.destroy', [$page, $pageSmall, $entity->id]) !!}"
                               data-toggle="modal" data-target="#supLocal""><i class="fa fa-trash-o"
                                                                               aria-hidden="true"></i></a>
                        </td>
                        @if($entity->sinistres->isNotEmpty())
                            <td>
                                <button type="button" class="btn btn-extia sinistres" data-toggle="modal"
                                        data-target="#sinistre" data-id="{{ $entity->id }}"
                                        data-tok="{{ csrf_token() }}"
                                        data-url="{{ route('listeRefSinistresByEntity', [$page, $pageSmall, $entity->id]) }}">
                                    <i class="fa fa-exclamation-triangle"></i></button>
                            </td>
                        @endif
                    </tr>
                @elseif($page == 'Vehicules')
                    <tr>
                        <td>{{ $entity->ad->numero_ad }}</td>

                        @forelse($champsFinal as $c)
                            @if($c->table_name == 'vehicules')
                                @if($c->old_name == 'pmc' || $c->old_name == 'atp')
                                    <td>{{ $entity[$c->old_name]->format('d/m/Y') }}</td>
                                @else
                                    <td>{{ $entity[$c->old_name] }}</td>
                                @endif
                            @elseif($c->table_name == 'marques')
                                <td>{{ $entity->marque[$c->old_name] }}</td>
                            @elseif($c->table_name == 'modeles')
                                <td>{{ $entity->modele[$c->old_name] }}</td>
                            @elseif($c->table_name == 'categories')
                                <td>{{ $entity->modele->category[$c->old_name] }}</td>
                            @elseif($c->table_name == 'contratV')
                                <td>{{ $entity->contratV[$c->old_name] }}</td>
                            @else
                                <td>{{ $entity->contratV->garantie[$c->old_name] }}</td>
                            @endif
                        @empty
                        @endforelse
                        <td>
                            <a class="btn btn-extia question-badge edition-badge"
                               href="{{ route('listeVehicules.edit', [$page, $pageSmall, $entity->id])}}"
                               data-id="{{ $entity->id }}" value=""><i class="fa fa-pencil-square-o"></i></a>
                            <a href="#" class="btn btn-extia delete-data"
                               data-sinistres="{{ $entity->contratV->sinistres->where('date_cloture', null)->count() }}"
                               data-url="{!! route('listeVehicules.destroy', [$page, $pageSmall, $entity->id]) !!}"
                               data-toggle="modal" data-target="#supLocal""><i class="fa fa-trash-o"
                                                                               aria-hidden="true"></i></a>
                        </td>
                        @if($entity->contratV->sinistres->isNotEmpty())
                            <td>
                                <button type="button" class="btn btn-extia sinistres" data-toggle="modal"
                                        data-target="#sinistre" data-id="{{ $entity->id }}"
                                        data-tok="{{ csrf_token() }}"
                                        data-url="{{ route('listeRefSinistresByEntity', [$page, $pageSmall, $entity->id]) }}">
                                    <i class="fa fa-exclamation-triangle"></i></button>
                            </td>
                        @endif
                    </tr>
                @elseif($page == 'Evenements')
                    <tr>
                        <td>{{ $entity->id }}</td>

                        @forelse($champsFinal as $c)
                            @if($c->table_name == 'evenements')
                                @if($c->old_name == 'date_reponse' || $c->old_name == 'date_demande')
                                    <td>{{ $entity[$c->old_name]->format('d/m/Y') }}</td>
                                @else
                                    <td>{{ $entity[$c->old_name] }}</td>
                                @endif
                            @endif
                        @empty
                        @endforelse
                        <td>
                            <div class="btn-top-bottom">
                                <a class="btn btn-extia question-badge edition-badge"
                                   href="{{ route('listeEvenements.edit', [$page, $pageSmall, $entity->id])}}"
                                   data-id="{{ $entity->id }}" value=""><i class="fa fa-pencil-square-o"></i></a>
                                <a href="#" class="btn btn-extia delete-data suppression"
                                   data-url="{!! route('listeEvenements.destroy', [$page, $pageSmall, $entity->id]) !!}"
                                   data-toggle="modal" data-target="#supLocal""><i class="fa fa-trash-o"
                                                                                   aria-hidden="true"></i></a>
                            </div>
                        </td>
                    </tr>
                @elseif($page == 'Sinistres')

                    @if($pageSmall == 'Véhicules')
                        <tr {{ $entity->date_cloture != null ? 'class=danger' : '' }} >
                            <td>{{ $entity->contratV->vehicule->ad->numero_ad }}</td>

                            @forelse($champsFinal as $c)
                                @if($c->table_name == 'sinistres')
                                    @if($c->old_name == 'date_reception' || $c->old_name == 'date_ouverture' || $c->old_name == 'date_sinistre')
                                        <td>{{ $entity[$c->old_name]->format('d/m/Y') }}</td>
                                    @elseif(!empty($entity->date_cloture) && $c->old_name == 'date_cloture')
                                        <td><b>{{ $entity[$c->old_name]->format('d/m/Y') }}</b></td>
                                    @elseif(empty($entity->date_cloture) && $c->old_name == 'date_cloture')
                                        <td>
                                            <a href="#" class="btn btn-extia cloture" data-toggle="modal"
                                               data-target="#cloture" data-id="{{ $entity->id }}"
                                               data-tok="{{ csrf_token() }}"
                                               data-url="{{ route('clotureSinistre', [$page, $pageSmall, $entity->id]) }}"><i
                                                        class="fa fa-minus-circle" aria-hidden="true"></i></a>
                                        </td>
                                    @else
                                        <td>{{ $entity[$c->old_name] }}</td>
                                    @endif
                                @elseif($c->table_name == 'marques')
                                    <td>{{ $entity->contratV->vehicule->marque[$c->old_name] }}</td>
                                @elseif($c->table_name == 'vehicules')
                                    <td>{{ $entity->contratV->vehicule[$c->old_name] }}</td>
                                @elseif($c->table_name == 'garanties')
                                    <td>{{ $entity->contratV->garantie[$c->old_name] }}</td>
                                @elseif($c->table_name == 'type_sinistre')
                                    <td>{{ $entity->typeSinistre[$c->old_name] }}</td>
                                @endif
                            @empty
                            @endforelse

                            <td>
                                @if($entity->date_cloture == null)
                                    <a class="btn btn-extia question-badge edition-badge"
                                       href="{{ route('listeSinistresVehicules.edit', [$page, $pageSmall, $entity->id])}}"
                                       data-id="{{ $entity->id }}" value="" disable><i
                                                class="fa fa-pencil-square-o"></i></a>
                                @else
                                    <p class="question-badge edition-badge" data-id="{{ $entity->id }}" value=""><i
                                                class="fa fa-ban" aria-hidden="true"></i></p>
                                @endif
                            </td>
                        </tr>
                    @else
                        <tr {{ $entity->date_cloture != null ? 'class=danger' : '' }} >

                            @if($entity->contrat->local_id != null)
                                <td>{{ $entity->contrat->local->ad->numero_ad }}</td>
                            @elseif($entity->contrat->algeco_id != null)
                                <td>{{ $entity->contrat->algeco->ad->numero_ad }}</td>
                            @elseif($entity->contrat->logement_id != null)
                                <td>{{ $entity->contrat->logement->ad->numero_ad }}</td>
                            @else
                                <td></td>
                            @endif

                            @forelse($champsFinal as $c)
                                @if($c->table_name == 'sinistres')
                                    @if($c->old_name == 'date_reception' || $c->old_name == 'date_ouverture' || $c->old_name == 'date_sinistre')
                                        <td>{{ $entity[$c->old_name]->format('d/m/Y') }}</td>
                                    @elseif(!empty($entity->date_cloture) && $c->old_name == 'date_cloture')
                                        <td><b>{{ $entity[$c->old_name]->format('d/m/Y') }}</b></td>
                                    @elseif(empty($entity->date_cloture) && $c->old_name == 'date_cloture')
                                        <td>
                                            <a href="#" class="btn btn-extia cloture" data-toggle="modal"
                                               data-target="#cloture" data-id="{{ $entity->id }}"
                                               data-tok="{{ csrf_token() }}"
                                               data-url="{{ route('clotureSinistre', [$page, $pageSmall, $entity->id]) }}"><i
                                                        class="fa fa-minus-circle" aria-hidden="true"></i></a>
                                        </td>
                                    @else
                                        <td>{{ $entity[$c->old_name] }}</td>
                                    @endif
                                @elseif($c->table_name == 'contrats')
                                    <td>{{ $entity->contrat[$c->old_name] }}</td>
                                @elseif($c->table_name == 'type_sinistre')
                                    <td>{{ $entity->typeSinistre[$c->old_name] }}</td>
                                @endif
                            @empty
                            @endforelse

                            <td>
                                @if($entity->date_cloture == null)
                                    <a class="btn btn-extia question-badge edition-badge"
                                       href="{{ route('listeSinistresMasse.edit', [$page, $pageSmall, $entity->id])}}"
                                       data-id="{{ $entity->id }}" value=""><i class="fa fa-pencil-square-o"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endif
                @else
                    <tr>
                        <td>{{ $entity->ad->numero_ad }}</td>
                        @forelse($champsFinal as $c)
                            @if($c->table_name == 'locaux')
                                <td>{{ $entity[$c->old_name] }}</td>
                            @elseif($c->table_name == 'baux')
                                @if($c->old_name == 'date_debut' || $c->old_name == 'date_signature' || $c->old_name == 'date_fin')
                                    <td>{{ $entity->bail[$c->old_name]->format('d/m/Y') }}</td>
                                @else
                                    <td>{{ $entity->bail[$c->old_name] }}</td>
                                @endif
                            @elseif($c->table_name == 'contrats')
                                @if($pageSmall == '>50RI')
                                    <td>
                                        @foreach($entity->contrats->where('num_contrat', '9322933') as $contrat)
                                            <p>{{ $contrat[$c->old_name] }}</p>
                                        @endforeach
                                    </td>
                                @elseif($pageSmall == 'RCPRO')
                                    <td>
                                        @foreach($entity->contrats->where('num_contrat', '971 0000 94067 F 50') as $contrat)
                                            <p>{{ $contrat[$c->old_name] }}</p>
                                        @endforeach
                                    </td>
                                @elseif($page == 'Entrepots')
                                    <td>
                                        @foreach($entity->contrats->where('num_contrat', '9453148') as $contrat)
                                            <p>{{ $contrat[$c->old_name] }}</p>
                                        @endforeach
                                    </td>
                                @elseif($page == 'AN')
                                    <td>
                                        @foreach($entity->contrats->where('num_contrat', '6665737') as $contrat)
                                            <p>{{ $contrat[$c->old_name] }}</p>
                                        @endforeach
                                    </td>
                                @endif
                            @endif
                        @empty
                        @endforelse
                        <td>
                            @forelse($entity->structures as $struc)
                                <span class="badge btn-cat">
                          {{ $struc->type_structure }}
                        </span>
                            @empty
                            @endforelse
                        </td>
                        <td>{{ $entity->chambresFroides->count() }}</td>
                        <td>
                            <button id="bail-{{$entity->bail_id}}" type="button" class="btn btn-extia bail"
                                    data-toggle="modal" data-target="#bail" data-id="{{ $entity->bail_id }}"
                                    data-tok="{{ csrf_token() }}" data-url="{{ route('bail.show', $entity->bail_id) }}">
                                Bail <i class="fa fa-eye"></i></button>
                        </td>
                        <td>
                            @if($page == 'Locaux')
                                <a class="btn btn-extia question-badge edition-badge"
                                   href="{{ route('listeLocaux.edit', [$page, $pageSmall, $entity->id])}}"
                                   data-id="{{ $entity->id }}" value=""><i class="fa fa-pencil-square-o"></i></a>
                                <a href="#" class="btn btn-extia delete-data"
                                   data-sinistres="{{ $entity->sinistres->where('date_cloture', null)->count() }}"
                                   data-url="{!! route('listeLocaux.destroy', [$page, $pageSmall, $entity->id]) !!}"
                                   data-toggle="modal" data-target="#supLocal""><i class="fa fa-trash-o"
                                                                                   aria-hidden="true"></i></a>
                            @endif
                            @if($page == 'ACI' && $pageSmall == '>50RI')
                                <a class="btn btn-extia question-badge edition-badge"
                                   href="{{ route('listeACI.edit', [$page, $pageSmall, $entity->id])}}"
                                   data-id="{{ $entity->id }}" value=""><i class="fa fa-pencil-square-o"></i></a>
                                <a href="" class="btn btn-extia delete-data"
                                   data-sinistres="{{ $entity->sinistres->where('date_cloture', null)->count() }}"
                                   data-url="{!! route('listeACI.destroy', [$page, $pageSmall, $entity->id]) !!}"
                                   data-toggle="modal" data-target="#supLocal""><i class="fa fa-trash-o"
                                                                                   aria-hidden="true"></i></a>
                            @endif
                            @if($page == 'ACI' && $pageSmall == 'RCPRO')
                                <a class="btn btn-extia question-badge edition-badge"
                                   href="{{ route('listeAciRCPRO.edit', [$page, $pageSmall, $entity->id])}}"
                                   data-id="{{ $entity->id }}" value=""><i class="fa fa-pencil-square-o"></i></a>
                                <a href="" class="btn btn-extia delete-data"
                                   data-sinistres="{{ $entity->sinistres->where('date_cloture', null)->count() }}"
                                   data-url="{!! route('listeAciRCPRO.destroy', [$page, $pageSmall, $entity->id]) !!}"
                                   data-toggle="modal" data-target="#supLocal""><i class="fa fa-trash-o"
                                                                                   aria-hidden="true"></i></a>
                            @endif
                            @if($page == 'Entrepots')
                                <a class="btn btn-extia question-badge edition-badge"
                                   href="{{ route('listeEntrepots.edit', [$page, $pageSmall, $entity->id])}}"
                                   data-id="{{ $entity->id }}" value=""><i class="fa fa-pencil-square-o"></i></a>
                                <a href="" class="btn btn-extia delete-data"
                                   data-sinistres="{{ $entity->sinistres->where('date_cloture', null)->count() }}"
                                   data-url="{!! route('listeEntrepots.destroy', [$page, $pageSmall, $entity->id]) !!}"
                                   data-toggle="modal" data-target="#supLocal""><i class="fa fa-trash-o"
                                                                                   aria-hidden="true"></i></a>
                            @endif
                            @if($page == 'AN')
                                <a class="btn btn-extia question-badge edition-badge"
                                   href="{{ route('listeBiensAN.edit', [$page, $pageSmall, $entity->id])}}"
                                   data-id="{{ $entity->id }}" value=""><i class="fa fa-pencil-square-o"></i></a>
                                <a href="" class="btn btn-extia delete-data"
                                   data-sinistres="{{ $entity->sinistres->where('date_cloture', null)->count() }}"
                                   data-url="{!! route('listeBiensAN.destroy', [$page, $pageSmall, $entity->id]) !!}"
                                   data-toggle="modal" data-target="#supLocal""><i class="fa fa-trash-o"
                                                                                   aria-hidden="true"></i></a>
                            @endif
                        </td>
                        @if($entity->sinistres->isNotEmpty())
                            <td>
                                <button type="button" class="btn btn-extia sinistres" data-toggle="modal"
                                        data-target="#sinistre" data-id="{{ $entity->id }}"
                                        data-tok="{{ csrf_token() }}"
                                        data-url="{{ route('listeRefSinistresByEntity', [$page, $pageSmall, $entity->id]) }}">
                                    <i class="fa fa-exclamation-triangle"></i></button>
                            </td>
                        @endif
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
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h2 class="modal-title" id="myModalLabel"><i class="fa fa-table" aria-hidden="true"></i>
                            Ajouter/supprimer des colonnes</h2>
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
                                                    <input id="{{ $champ->new_name }}" type="checkbox" name="columns[]"
                                                           value="{{ $champ->old_name }}" {{ $champ->status == 1 ? 'checked' : ''}}/>
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
                        <button id="addColumns" type="submit" class="btn btn-extia">Valider <i class="fa fa-check"></i>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Modal pour choix colonnes export-->
    <div class="modal fade" id="export-locaux" tabindex="-1" role="dialog" aria-labelledby="export-locaux">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <form action="{{ route('downloadExcel', [$page, $pageSmall, 'xls']) }}" method="POST">
                    {{csrf_field()}}

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h2 class="modal-title" id="myModalLabel"><i class="fa fa-table" aria-hidden="true"></i> Choix
                            des colonnes pour l'export</h2>
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
                                                    <input id="{{ $champ->new_name }}" type="checkbox" name="columns[]"
                                                           value="{{ $champ->old_name }}" {{ $champ->status == 1 ? 'checked' : ''}}/>
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
                        <div class="exportIds">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                        <button id="exportExcel" type="submit" class="btn btn-extia">Exporter (.xls) <span
                                    class="glyphicon glyphicon-export" aria-hidden="true"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @isset($entity)
        <!-- Modal pour vue/edition des baux -->
        <div class="modal fade" id="bail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    <form id="bail_update" action="{{ route('bail.update', $entity->bail_id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            @if($page != 'Algecos' )
                                <h2 class="modal-title" id="myModalLabel"><i class="fa fa-table" aria-hidden="true"></i>
                                    Bail associé à ce Local</h2>
                            @else
                                <h2 class="modal-title" id="myModalLabel"><i class="fa fa-table" aria-hidden="true"></i>
                                    Bail associé à cet Algéco</h2>
                            @endif
                        </div>
                        <div class="modal-body">
                            <div class="row add-data-bail">
                                <!-- partie js ppour remplir les données du bail-->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="close-bail" type="button" class="btn btn-default" data-dismiss="modal">Fermer
                            </button>
                            <button type="submit" class="btn" disabled="">Editer</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Modal pour afficher les sinistres d'une entité-->
        <div class="modal fade" id="sinistre" tabindex="-1" role="dialog" aria-labelledby="myModalSinistre">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <form id="sinistresById" action="{{ route('filterSinistresByref') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h2 class="modal-title" id="myModalSinistre"><i class="fa fa-exclamation-triangle"
                                                                            aria-hidden="true"></i> Sinistre(s)</h2>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">


                                    <table class="table">
                                        <thead>
                                        <tr>
                                            @if($page == 'Locaux')
                                                <th>N° contrat</th>
                                            @endif
                                            <th>Référence RDC</th>
                                            <th>Référence MACIF</th>
                                            <th>Date sinistre</th>
                                        </tr>
                                        </thead>
                                        <tbody class="add-ref">

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer voir-tout">
                            <button id="" type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal edition chambre froide -->
        <div class="modal fade" id="editCF" tabindex="-1" role="dialog" aria-labelledby="CF">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="CF">
                            <i class="fa fa-pencil-square-o"></i>
                            Edition de la chambre froide
                        </h4>
                    </div>
                    <form id="edit-form-cf" action="" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="modal-body">

                            <div class="form-inline">
                                <p>Modifier la valeur du <b>Volume</b> de la chambre froide : <input type="text"
                                                                                                     name="volume"
                                                                                                     class="form-control volume">
                                </p>
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

        <!-- Modal cloture date_cloture -->
        <div class="modal fade" id="cloture" tabindex="-1" role="dialog" aria-labelledby="CF">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="CF">
                            <i class="fa fa-times"></i>
                            Cloture du sinistre
                        </h4>
                    </div>
                    <form id="cloture-sinistre" action="" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="modal-body">
                            <div class="form-inline">
                                <p>Veuillez indiquer la <b>date de cloture</b> pour ce sinistre : <input type="date" name="date_cloture" class="form-control volume">
                                </p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default " data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-extia cloture-save">Sauvegarder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal surpression local / Algéco / chambre froide / vehicules etc-->
        <div class="modal fade" id="supLocal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel2">
                            <i class="fa fa-times"></i>
                            Suppression
                        </h4>
                    </div>
                    <form id="delete-form" action="" method="POST">
                        <input type="hidden" name="_method" value="DELETE">

                        <input id="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">


                        <div class="modal-body">
                            @if($page == 'Algecos')
                                <div class="alert alert-danger alert-dismissible alertSinistres" role="alert">
                                    <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        Attention!</strong> Vous avez <b class="warning"><span
                                                class="countSinistres"></span> sinistre(s)</b> en attente d'être
                                    clôturé(s) pour cet algéco
                                </div>

                                <p class="huge2"><b>Etes vous sûr de vouloir supprimer cet algéco ?</b></p>
                            @elseif($page == 'Chambres-froides')
                                <div class="alert alert-danger alert-dismissible alertSinistres" role="alert">
                                    <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        Attention!</strong> Vous avez <b class="warning"><span
                                                class="countSinistres"></span> sinistre(s)</b> en attente d'être
                                    clôturé(s) pour cette chambre froide
                                </div>
                                <p class="huge2"><b>Etes vous sûr de vouloir supprimer cette chambre froide ?</b></p>
                            @elseif($page == 'Vehicules')

                                <div class="alert alert-danger alert-dismissible alertSinistres" role="alert">
                                    <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        Attention!</strong> Vous avez <b class="warning"><span
                                                class="countSinistres"></span> sinistre(s)</b> en attente d'être
                                    clôturé(s) pour ce véhicule
                                </div>

                                <p><b>Etes-vous sûr de vouloir supprimer ce véhicule ?</b></p>

                                <div class="form-inline">
                                    <p>Si oui, veuillez indiquer la <b>date de résiliation effective</b> : <input
                                                type="date" name="date_resiliation" class="form-control"></p>
                                </div>
                                <div class="form-group">
                                    <p><b>Motif de la résiliation</b> : <textarea name="motif" class="form-control"
                                                                                  rows="3"></textarea></p>
                                </div>
                            @elseif($page == 'Evenements')
                                <p><b>Etes-vous sûr de vouloir supprimer cet évènement ?</b></p>
                            @else
                                <div class="alert alert-danger alert-dismissible alertSinistres" role="alert">
                                    <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        Attention!</strong> Vous avez <b class="warning"><span
                                                class="countSinistres"></span> sinistre(s)</b> en attente d'être
                                    clôturé(s) pour ce local
                                </div>

                                <p class="huge2"><b>Etes vous sûr de vouloir supprimer ce local?</b></p>

                                <div class="form-inline">
                                    <p>Si oui, veuillez indiquer la <b>date de résiliation effective</b> : <input
                                                type="date" name="date_resiliation" class="form-control"></p>
                                </div>
                                <div class="form-group">
                                    <p><b>Motif de la résiliation</b> : <textarea name="motif" class="form-control"
                                                                                  rows="3"></textarea></p>
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