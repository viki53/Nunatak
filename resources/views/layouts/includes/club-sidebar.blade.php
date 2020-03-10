@php
$route = Route::current();
$name = $route->getName();

if (!isset($club)) {
	if (isset($site)) {
		$club = $site->club;
	}
}
@endphp

<div class="list-group">
	<a href="{{ route('club.edit', ['club' => $club]) }}" class="list-group-item list-group-item-action @if(Str::startsWith($name, 'club.edit')) active @endif">{{ __('Modifier') }}</a>
	<a href="{{ route('club.sites', ['club' => $club]) }}" class="list-group-item list-group-item-action @if(Str::startsWith($name, 'club.sites') || Str::startsWith($name, 'site.')) active @endif">{{ __('Sites gérés') }}</a>
	<a href="{{ route('club.members', ['club' => $club]) }}" class="list-group-item list-group-item-action @if(Str::startsWith($name, 'club.members')) active @endif">{{ __('Gestion des membres') }}</a>
</div>

@if(Str::startsWith($name, 'site.') || Str::startsWith($name, 'club.sites'))@php
$club->load(['sites']);
$paramSite = $route->parameter('site');
@endphp
<div class="list-group mt-3">
	<p class="list-group-item disabled" aria-disabled="true"><strong>Sites</strong></p>
	@foreach($club->sites as $site)
	<a href="{{ route('site.pages', ['site' => $site]) }}" class="list-group-item list-group-item-action @if(!empty($paramSite) && $paramSite->id === $site->id) active @endif">{{ $site->title }}</a>
	@endforeach
</div>
@endif

@yield('sidebar')
