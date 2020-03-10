<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@if(!empty($page)){{ $page->last_revision->title}} — @endif{{ $site->title }}</title>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

	<!-- Styles -->
	<link href="{{ asset('css/site.css') }}" rel="stylesheet">
</head>
<body>
	<a class="sr-only sr-only-focusable" href="#main-menu">{{ __('Aller au menu') }}</a>
	<a class="sr-only sr-only-focusable" href="#main-content">{{ __('Aller au contenu principal') }}</a>
	@yield('quicklinks')

	<div id="app">
		<nav id="main-menu" class="navbar navbar-light bg-white navbar-expand-md">
			<div class="container">
				<a class="navbar-brand" href="{{ url('/') }}">{{ $site->title }}</a>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Afficher/cacher la navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Left Side Of Navbar -->
					<ul class="navbar-nav mr-auto">
						@if(!empty($page))
						@auth
						<li class="nav-item">
							<a href="{{ route('site.pages.edit', ['site' => $site, 'page' => $page]) }}" class="btn btn-primary">Modifier</a>
						</li>
						@endauth
						@endif
					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="navbar-nav ml-auto">
						<!-- Authentication Links -->
						@guest
						<li class="nav-item">
							<a class="btn btn-outline-primary" href="{{ route('login') }}">{{ __('Connexion') }}</a>
						</li>
						@if (Route::has('register'))
						<li class="nav-item ml-1">
							<a class="btn btn-primary" href="{{ route('register') }}">{{ __('Inscription') }}</a>
						</li>
						@endif
						@else
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('user.invitations') }}">
									{{ __('Invitations') }}
								</a>
								<a class="dropdown-item" href="{{ route('user.profile') }}">
									{{ __('Mon compte') }}
								</a>

								<div class="dropdown-divider"></div>

								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
									{{ __('Déconnexion') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</div>
						</li>
						@endguest
					</ul>
				</div>
			</div>
		</nav>

		<main id="main-content" class="py-4">
			@yield('content')
		</main>
	</div>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
