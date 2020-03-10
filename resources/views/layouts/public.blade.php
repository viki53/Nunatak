<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name') }}</title>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" async>

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
	<a class="sr-only sr-only-focusable" href="#main-menu">{{ __('Aller au menu') }}</a>
	<a class="sr-only sr-only-focusable" href="#main-content">{{ __('Aller au contenu principal') }}</a>
	@yield('quicklinks')

	<div id="app">
		@include('layouts.includes.navbar')

		<main id="main-content" class="py-4">
			@yield('content')
		</main>
	</div>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
