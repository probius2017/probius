<!DOCTYPE html>
<html>
    <head>
        <title>Probius - @yield('title')</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        {!! Html::style('assets/css/bootstrap.min.css') !!}
        {!! Html::style('assets/css/font-awesome.min.css') !!}
        {!! Html::style('assets/noty-3.1.0/lib/noty.css') !!}
        {!! Html::style('assets/css/app.css') !!}
    </head>
    <body>

        @include('partials.header')

        <div class="container">
            @yield('content')
        </div>

        @include('partials.footer')
        
        {!! Html::script('assets/js/jquery-2.1.4.min.js') !!}
        {!! Html::script('assets/js/bootstrap.min.js') !!}
        {!! Html::script('assets/noty-3.1.0/lib/noty.js') !!}
        {!! Html::script('assets/js/master.js') !!}

        <script type="text/javascript">
            @yield('script')
        </script>
    </body>
</html>