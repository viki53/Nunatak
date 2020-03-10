<div id="main-menu" class="navbar">
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
