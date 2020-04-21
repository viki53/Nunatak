@php
$route = Route::current();
$routeName = $route->getName();
$params = (object) $route->parameters();

$paramClub = null;
if (!empty($params->club)) {
	$paramClub = $params->club;
}
elseif (!empty($params->site)) {
	$paramSite = $params->site;
	$paramClub = $params->site->club;
}

$user_clubs = Auth::user()->clubs;
@endphp

<nav id="sidebar">
	<div id="sidebar-content">
		<h1 class="sr-only">{{ __('Menu principal') }}</h1>
		<div id="sidebar-club-selector" class="dropdown">
			<h1 class="dropdown-label">@if(!empty($paramClub)){{ $paramClub->name }}@else{{ __('Choisir un club') }}@endif</h1>

			<div id="sidebar-club-selector-list" class="dropdown-values">
				<a href="{{ route('dashboard') }}" class="dropdown-item @if($routeName === 'dashboard') selected @endif" title="{{ __('Voir votre page principale') }}">{{ __('Tableau de bord') }}</a>
				@foreach($user_clubs as $c)
				<a href="{{ route('club.edit', ['club' => $c]) }}" class="dropdown-item @if(!empty($paramClub) && $paramClub->id === $c->id) selected @endif" title="Vous êtes membre depuis le {{ $c->pivot->created_at->isoFormat('DD MMMM YYYY') }}">{{ $c->name }}</a>
				@endforeach
			</div>
		</div>

		@if(!empty($paramClub))
		<div class="sidebar-list">
			@can('update', $paramClub)
			<a href="{{ route('club.edit', ['club' => $paramClub]) }}" class="sidebar-item @if(Str::startsWith($routeName, 'club.edit')) active @endif">{{ __('Modifier') }}</a>
			@endcan
			<a href="{{ route('club.members', ['club' => $paramClub]) }}" class="sidebar-item @if(Str::startsWith($routeName, 'club.members')) active @endif">{{ __('Gestion des membres') }}</a>
			<a href="{{ route('club.sites', ['club' => $paramClub]) }}" class="sidebar-item @if(Str::startsWith($routeName, 'club.sites') || Str::startsWith($routeName, 'site.')) active @endif">{{ __('Sites gérés') }}</a>
		</div>

			@if(Str::startsWith($routeName, 'club.') || Str::startsWith($routeName, 'site.'))
			@php
			$paramClub->load(['sites']);
			@endphp
			<div id="sidebar-club-selector" class="dropdown">
				<h1 class="dropdown-label">@if(!empty($paramSite)){{ $paramSite->title }}@else{{ __('Choisir un site') }}@endif</h1>

				<div id="sidebar-club-selector-list" class="dropdown-values">
					@foreach($paramClub->sites as $s)
					<a href="{{ route('site.pages', ['site' => $s]) }}" class="dropdown-item @if(!empty($paramSite) && $paramSite->id === $s->id) selected @endif">{{ $s->title }}</a>
					@endforeach
				</div>
			</div>
			@endif

			@if(!empty($paramSite) && (Str::startsWith($routeName, 'site.') || Str::startsWith($routeName, 'club.sites')))
			@php
			$paramSite->load(['pages']);
			$paramPage = $route->parameter('page');
			@endphp
			<div class="sidebar-list">
				<h1 class="sr-only">{{ __('Choisir une page') }}</h1>
				@foreach($site->pages as $p)
				@can('update', $p)
				<a href="{{ route('site.pages.edit', ['site' => $paramSite, 'page' => $p]) }}" class="sidebar-item @if(!empty($paramPage) && $paramPage->id === $p->id) active @endif">{{ $p->last_revision->title }}</a>
				@endcan
				@endforeach
			</div>
			@endif
		@endif

		@yield('sidebar')
	</div>

	<div id="sidebar-footer">
		@if(count(Auth::user()->invitations))
		<a href="{{ route('user.invitations') }}" class="sidebar-item @if($routeName === 'user.invitations') active @endif">{{ __('Invitations en attente') }}</a>
		@endif
		<a href="{{ route('user.profile') }}" class="sidebar-item @if($routeName === 'user.profile') active @endif">{{ __('Mon compte') }}</a>
		<a href="{{ route('user.password') }}" class="sidebar-item @if($routeName === 'user.password') active @endif">{{ __('Changer de mot de passe') }}</a>
		<form method="POST" action="{{ route('logout') }}">
			@csrf
			<button type="submit" class="sidebar-item">{{ __('Déconnexion') }}</button>
		</form>
	</div>
</nav>
