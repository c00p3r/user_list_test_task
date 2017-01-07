<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <?php $title = config('app.name', 'Site') . ' | ' . (isset($page_title) ? $page_title : 'Page title'); ?>

    <title>{{ $title }}</title>

    @if(config('app.env') == 'production')
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    @else
        {{ Html::style('css/app.css') }}
    @endif

@yield('styles')

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="@yield('body-page-class')">

@include('_header')

@include('_notifications')

@yield('content')

@include('_footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="{{ asset('js/vendor/jquery.min.js') }}"><\/script>')</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script>(typeof $().emulateTransitionEnd == 'function') || document.write('<script src="{{ asset('js/vendor/bootstrap.min.js') }}"><\/script>')</script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>

{{ Html::script('assets/front/js/mutual.js') }}

@if(config('app.env') == 'production')
    <script src="{{ elixir('js/app.js') }}"></script>
@else
    {{ Html::script('js/app.js') }}
@endif

@yield('scripts')

</body>
</html>