@php
$name = Route::currentRouteName();
@endphp
<div class="col-md-3 mb-3">
	<div class="list-group">
		<a href="{{ route('club.edit', ['club' => $club]) }}" class="list-group-item list-group-item-action @if($name === 'club.edit') active @endif }}">{{ __('Modifier') }}</a>
		<a href="{{ route('club.sites', ['club' => $club]) }}" class="list-group-item list-group-item-action @if($name === 'club.sites') active @endif }}">{{ __('Sites gérés') }}</a>
		<a href="{{ route('club.sports', ['club' => $club]) }}" class="list-group-item list-group-item-action @if($name === 'club.sport') active @endif }}">{{ __('Sports proposés') }}</a>
		<a href="{{ route('club.members', ['club' => $club]) }}" class="list-group-item list-group-item-action @if($name === 'club.members') active @endif">{{ __('Gestion des membres') }}</a>
	</div>
</div>
