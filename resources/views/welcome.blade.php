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
		@include('layouts.includes.navbar')
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
