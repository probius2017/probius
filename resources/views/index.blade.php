@extends('layouts.master')

@section('title', 'Welcome')

@section('content')
<div class="row flex-login">
    <div class="col-md-4">
        <div class="login-panel panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><img src="{{ asset('assets/img/rdc-badge.png') }}" alt="logo rdc" width="25" height="25"> Se connecter</h3>
            </div>
            <div class="panel-body">
                
                <form action="{{ route('login') }}" method="post">
                {{csrf_field()}}
                    <fieldset>
                        @if($errors->has('login')) 
                        <div class="form-group has-error">
                            <div class="input-group">
                                <input class="form-control" type="text" name="login" placeholder="Identifiant" autofocus="autofocus" value="{{ old('login') }}">
                                <div class="input-group-addon"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></div>
                            </div>
                        </div>
                        @else
                        <div class="form-group">
                            <input class="form-control" type="text" name="login" placeholder="Identifiant" autofocus="autofocus" value="{{ old('login') }}">
                        </div>
                        @endif

                        @if($errors->has('password'))
                        <div class="form-group has-error">
                            <div class="input-group">
                                <input class="form-control" type="password" name="password" placeholder="Mot de passe" autofocus="autofocus">
                                <div class="input-group-addon"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></div>
                            </div>
                        </div>
                        @else 
                        <div class="form-group">
                            <input class="form-control" type="password" name="password" placeholder="Mot de passe" autofocus="autofocus">
                        </div>
                        @endif

                        <div id="remember" class="checkbox">
                            <label>
                                <input type="checkbox" value="yes" name="remember"> Se rappeler de moi 
                            </label>
                        </div>
                    </fieldset>
                    
                    <br>

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