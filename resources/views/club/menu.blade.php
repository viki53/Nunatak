@php
$route = Route::current();
$name = $route->getName();
@endphp
<div class="col-md-3 mb-3">
	<div class="list-group">
		<a href="{{ route('club.edit', ['club' => $club]) }}" class="list-group-item list-group-item-action @if(Str::startsWith($name, 'club.edit')) active @endif">{{ __('Modifier') }}</a>
		<a href="{{ route('club.sites', ['club' => $club]) }}" class="list-group-item list-group-item-action @if(Str::startsWith($name, 'club.sites') || Str::startsWith($name, 'site.')) active @endif">{{ __('Sites gérés') }}</a>
		<a href="{{ route('club.sports', ['club' => $club]) }}" class="list-group-item list-group-item-action @if(Str::startsWith($name, 'club.sport')) active @endif">{{ __('Sports proposés') }}</a>
		<a href="{{ route('club.members', ['club' => $club]) }}" class="list-group-item list-group-item-action @if(Str::startsWith($name, 'club.members')) active @endif">{{ __('Gestion des membres') }}</a>
	</div>

	@if(Str::startsWith($name, 'site.') || Str::startsWith($name, 'club.sites'))@php
	$club->load(['sites']);
	$paramSite = $route->parameter('site');
	@endphp
	<div class="list-group mt-3">
		@foreach($club->sites as $site)
		<a href="{{ route('site.pages', ['site' => $site]) }}" class="list-group-item list-group-item-action @if(!empty($paramSite) && $paramSite->id === $site->id) active @endif">{{ $site->title }}</a>
		@endforeach
	</div>
	@endif
</div>
