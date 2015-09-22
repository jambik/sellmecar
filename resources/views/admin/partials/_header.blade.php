<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
		@yield('head')
		<link href="{{ asset('/css/admin.bundle.css') }}" type="text/css" rel="stylesheet" />
		<link href="{{ asset('/css/admin.css') }}" type="text/css" rel="stylesheet" />
		<script src="{{ asset('/js/admin.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('/js/admin.js') }}" type="text/javascript"></script>
		<title>{{ $title ?: 'Администрирование - Sellmecar' }}</title>
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>