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
	<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>
	<nav id="quicklinks">
		<a href="#main-menu">{{ __('Aller au menu') }}</a>
		<a href="#main-content">{{ __('Aller au contenu principal') }}</a>
		@yield('quicklinks')
	</nav>

	<div id="app">
		@include('layouts.includes.navbar')

		<div id="page">
			@include('layouts.includes.dashboard-sidebar')

			<main id="main-content">
				@yield('hero')

				@if (session('status'))
				<div id="notifications-zone">
					<p class="notification is-success" role="alert">{{ session('status') }}</p>
				</div>
				@endif

				@yield('content')
			</main>
		</div>
	</div>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
