<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    @yield('head')
    {{--<link href='http://fonts.googleapis.com/css?family=Cuprum:400,700&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css'>--}}
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href="{{ asset('/css/app.bundle.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('/css/app.css') }}" type="text/css" rel="stylesheet" />
    <script src="{{ asset('/js/app.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrxH2cAEZwZGhQlJbnxTE6lqN6PXiYdNo&amp;libraries=places&amp;language=ru" type="text/javascript"></script>
    <title>{{ $title ?: 'Sellmecar' }}</title>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="body">