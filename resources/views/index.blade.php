@extends('layouts.master')

@section('title', 'Welcome')

@section('content')
    <div class="row flex-login"><img id="accueil-background" src="{{ asset('assets/img/accueil-resto.jpg') }}"
                                     alt="logo rdc">
        <div >

            <!-- Button trigger modal -->
            <button type="button" class="z-devant" data-toggle="modal" data-target="#myModalLogin">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
            </button>

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade myModalLogin-sm" id="myModalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="panel-info">
                    <button type="button" class="close" id="cross-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="panel-heading co-affiche">
                        <h3 class="panel-title"><img src="{{ asset('assets/img/rdc-badge.png') }}" alt="logo rdc" width="25" height="25"> Se connecter</h3>
                    </div>

                </div>
                <div class="modal-body">
                    <form action="{{ route('login') }}" method="post">
                        {{csrf_field()}}
                        <fieldset>
                            @if($errors->has('login'))
                                <div class="form-group has-error">
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="login" placeholder="Identifiant"
                                               autofocus="autofocus" value="{{ old('login') }}">
                                        <div class="input-group-addon"><i class="fa fa-exclamation-circle"
                                                                          aria-hidden="true"></i></div>
                                    </div>
                                </div>
                            @else
                                <div class="form-group">
                                    <input class="form-control" type="text" name="login" placeholder="Identifiant"
                                           autofocus="autofocus" value="{{ old('login') }}">
                                </div>
                            @endif

                            @if($errors->has('password'))
                                <div class="form-group has-error">
                                    <div class="input-group">
                                        <input class="form-control" type="password" name="password"
                                               placeholder="Mot de passe" autofocus="autofocus">
                                        <div class="input-group-addon"><i class="fa fa-exclamation-circle"
                                                                          aria-hidden="true"></i></div>
                                    </div>
                                </div>
                            @else
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password"
                                           placeholder="Mot de passe" autofocus="autofocus">
                                </div>
                            @endif

                            <div id="remember" class="checkbox">
                                <label>
                                    <input type="checkbox" value="yes" name="remember"> Se rappeler de moi
                                </label>
                            </div>
                        </fieldset>
                </div>
                <div>
                    <div class="connection">
                        <button type="submit" class="btn btn-extia">Connection <i class="fa fa-rocket"></i></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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