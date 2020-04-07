<div id="main-menu" class="navbar">
	<nav class="navbar-left">
		<button class="navbar-item sidebar-toggler" type="button" aria-controls="sidebar" aria-expanded="false" aria-label="{{ __('Afficher/cacher la navigation') }}">
			<span class="sidebar-toggler-icon"></span>
		</button>

		<a href="/" class="navbar-item navbar-logo">{{ config('app.name') }}</a>
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
