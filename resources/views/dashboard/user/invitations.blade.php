@extends('layouts.dashboard')

@section('content')
<header class="hero">
	<h1 class="title">{{ config('app.name') }}</h1>
	<p class="subtitle">{{ __('Bienvenue, :name', ['name' => $user->name]) }}</p>
</header>

@if (session('status'))
<div class="alert success" role="alert">
	{{ session('status') }}
</div>
@endif

<div class="columns-container">
	<div class="column">
		@if(!count($user->invitations))
		<p class="lead">
			{{ trans_choice('{0} Vous n\'avez aucune invitation en attente|{1} Vous avez une invitation en attente|[2,*] Vous avez :count invitations en attente', count($user->invitations), ['count' => count($user->invitations)]) }}
		</p>
		@endif
		@foreach($user->invitations as $invitation)
		<div class="card mb-3">
			<h2 class="card-header">{{ $invitation->club->name }}</h2>

			<div class="card-body">
				<form method="POST" action="{{ route('user.invitations.accept', ['invitation' => $invitation]) }}" class="float-right ml-2">
					@csrf
					@method('POST')

					<button type="submit" class="btn btn-outline-success">{{ __('Accepter') }}</button>
				</form>

				<form method="POST" action="{{ route('user.invitations.reject', ['invitation' => $invitation]) }}" class="float-right ml-2">
					@csrf
					@method('DELETE')

					<button type="submit" class="btn btn-outline-danger">{{ __('Refuser') }}</button>
				</form>

				<p>{!! __('Depuis <time datetime=":date_iso" title="Depuis le :date_formatted, pour être exact">:date_absolute</time>', ['date_iso' => $invitation->created_at->toIso8601String(), 'date_formatted' => $invitation->created_at->isoFormat('dddd D MMMM YYYY [à] HH[h]mm'), 'date_absolute' => $invitation->created_at->diffForHumans()]) !!}</p>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection
