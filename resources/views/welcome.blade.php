<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>{{ config('app.name') }}</title>

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

		<!-- Styles -->
		<style>
			html, body {
				background-color: #fff;
				color: #242729;
				font-family: 'Nunito', sans-serif;
				font-weight: 200;
				height: 100vh;
				margin: 0;
				background-size: cover;
				background-position: center;
			}

			.full-height {
				height: 100vh;
				background-color: rgba(255, 255, 255, .1);
			}

			.flex-center {
				align-items: center;
				display: flex;
				justify-content: center;
			}

			.position-ref {
				position: relative;
			}

			.top-right {
				position: absolute;
				top: 0;
				right: 0;
				width: 100%;
				padding: 0;
				display: flex;
				justify-content: right;
				background-color: #fff;
				box-shadow: 0 0 4px rgba(31, 31, 31, .5);
			}

			.content {
				text-align: center;
			}

			.title {
				font-size: 84px;
				text-shadow: 0 0 5px rgba(255, 255, 255, .7);
			}

			.links > a {
				display: inline-block;
				color: inherit;
				padding: 18px 25px;
				font-size: 13px;
				font-weight: 600;
				letter-spacing: .1rem;
				text-decoration: none;
				text-transform: uppercase;
			}

			.m-b-md {
				margin-bottom: 30px;
			}


			@media (prefers-color-scheme: dark) {
				html, body {
					background-color: #212529;
					color: #f8fafc;
				}
				.navbar {
					background-color: black !important;
					color: white;
				}
				.navbar a {
					color: inherit;
				}
				.full-height {
					background-color: rgba(0, 0, 0, .1);
				}
				.top-right {
					background-color: #000;
				}
				.title {
					font-size: 84px;
					text-shadow: 0 0 5px rgba(0, 0, 0, .7);
				}
			}
		</style>
	</head>
	<body style="background-image: url('/storage/splashscreens/{{ $splashscreen->file_name }}');">
		<div class="flex-center position-ref full-height">
			@if (Route::has('login'))
				<div class="top-right links">
					@auth
						<a href="{{ route('dashboard') }}">{{ __('Tableau de bord') }}</a>
					@else
						<a href="{{ route('login') }}">{{ __('Connexion') }}</a>

						@if (Route::has('register'))
							<a href="{{ route('register') }}">{{ __('Inscription') }}</a>
						@endif
					@endauth
				</div>
			@endif

			<div class="content">
				<div class="title m-b-md">{{ config('app.name') }}</div>

				<div class="links">{{ __('La plateforme pour les associations') }}</div>

				<div class="links">
					@foreach($sports as $sport)
					<a href="{{ route('clubs').'/'.$sport->slug }}">{{ $sport->name }}</a>@if (!$loop->last) | @endif
					@endforeach
				</div>
			</div>
		</div>
	</body>
</html>
