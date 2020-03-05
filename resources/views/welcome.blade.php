<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>{{ config('app.name') }}</title>

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
		<!-- Styles -->
		<link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
	</head>
	<body>
		<div class="navbar">
			<div class="container">
				<nav class="navbar-left">
					<a href="" class="navbar-item navbar-logo">{{ config('app.name') }}</a>
				</nav>
				<nav class="navbar-right">
				@auth
					<a href="{{ route('dashboard') }}" class="navbar-item">{{ __('Tableau de bord') }}</a>
				@else
					<a href="{{ route('login') }}" class="navbar-item">{{ __('Connexion') }}</a>
					<a href="{{ route('register') }}" class="navbar-item">{{ __('Inscription') }}</a>
				@endauth
				</nav>
			</div>
		</div>
		<div class="splashscreen">
			<div class="container">
				<div class="splashscreen-content">
					<h1 class="brand">{{ config('app.name') }}</h1>

					<div class="slogan">
						<span>La plateforme pour</span>
						<span>les associations sportives</span>
					</div>

					<nav class="sports-list">
						<div class="lane">
							@foreach($sports as $sport)
							<a href="{{ route('clubs').'/'.$sport->slug }}">{{ $sport->name }}</a>
								@if ($loop->iteration%6 === 0 && !$loop->last)
						</div>
						<div class="lane">
								@elseif ($loop->iteration%3 === 0 && !$loop->last)
							<br>
								@endif
							@endforeach
						</div>
					</nav>
				</div>
			</div>
		</div>
	</body>
</html>
