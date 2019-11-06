@php
$name = Route::currentRouteName();
@endphp
<div class="col-md-3 mb-3">
	<div class="list-group mb-3">
		<a href="{{ route('user.invitations') }}" class="list-group-item list-group-item-action @if($name === 'user.invitations') active @endif">{{ __('Invitations en attente') }}</a>
	</div>
	<div class="list-group">
		<a href="{{ route('user.profile') }}" class="list-group-item list-group-item-action @if($name === 'user.profile') active @endif }}">{{ __('Mon compte') }}</a>
		<a href="{{ route('user.password') }}" class="list-group-item list-group-item-action @if($name === 'user.password') active @endif">{{ __('Changer de mot de passe') }}</a>
	</div>
</div>
