@php
$route = Route::current();
$name = $route->getName();
$params = (object) $route->parameters();

$club = null;
if (!empty($params->club)) {
	$club = $params->club;
}
elseif (!empty($params->site)) {
	$club = $params->site->club;
}

$user_clubs = Auth::user()->clubs;
@endphp

<label id="sidebar-club-selector" class="dropdown">
	<a href="#sidebar-club-selector-list" class="dropdown-label sidebar-item">@if(!empty($club)){{ $club->name }}@else{{ __('Choisir un club') }}@endif</a>

	<div id="sidebar-club-selector-list" class="dropdown-values">
		@foreach($user_clubs as $c)
		<a href="{{ route('club.edit', ['club' => $c]) }}" class="dropdown-item sidebar-item @if(!-empty($club) && $club->id === $c->id) selected @endif" title="Vous êtes membre depuis le {{ $c->pivot->created_at->isoFormat('DD MMMM YYYY') }}">{{ $c->name }}</a>
		@endforeach
	</div>
</label>

@if(!empty($club))
<div class="sidebar-list">
	<a href="{{ route('club.edit', ['club' => $club]) }}" class="sidebar-item @if(Str::startsWith($name, 'club.edit')) active @endif">{{ __('Modifier') }}</a>
	<a href="{{ route('club.sites', ['club' => $club]) }}" class="sidebar-item @if(Str::startsWith($name, 'club.sites') || Str::startsWith($name, 'site.')) active @endif">{{ __('Sites gérés') }}</a>
	<a href="{{ route('club.members', ['club' => $club]) }}" class="sidebar-item @if(Str::startsWith($name, 'club.members')) active @endif">{{ __('Gestion des membres') }}</a>
</div>

@if(Str::startsWith($name, 'site.') || Str::startsWith($name, 'club.sites'))@php
$club->load(['sites']);
$paramSite = $route->parameter('site');
@endphp
<div class="sidebar-list">
	<strong class="sidebar-item disabled" aria-disabled="true">Sites</strong>
	@foreach($club->sites as $site)
	<a href="{{ route('site.pages', ['site' => $site]) }}" class="sidebar-item @if(!empty($paramSite) && $paramSite->id === $site->id) active @endif">{{ $site->title }}</a>
	@endforeach
</div>
@endif
@endif

@yield('sidebar')
