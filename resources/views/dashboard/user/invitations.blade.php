@extends('layouts.dashboard')

@section('content')
<header class="hero">
	<h1 class="title">{{ config('app.name') }}</h1>
	<p class="subtitle">{{ __('Bienvenue, :name', ['name' => $user->name]) }}</p>
</header>

@if (session('status'))
<div class="alert is-success" role="alert">
	{{ session('status') }}
</div>
@endif

<div class="columns-container">
	<div class="column">
		@if(!count($user->invitations))
		<p class="alert is-success">{{ __('Vous n\'avez aucune invitation en attente') }}</p>
		@else
		<p class="alert is-info">{{ trans_choice('{1} Vous avez une invitation en attente|[2,*] Vous avez :count invitations en attente', count($user->invitations), ['count' => count($user->invitations)]) }}</p>
		@endif

		@foreach($user->invitations as $invitation)
		<div class="card">
			<h2 class="card-header">{{ $invitation->club->name }}</h2>

			<div class="card-body">
				<p>{!! __('Depuis <time datetime=":date_iso" title="Depuis le :date_formatted, pour être exact">:date_absolute</time>', ['date_iso' => $invitation->created_at->toIso8601String(), 'date_formatted' => $invitation->created_at->isoFormat('dddd D MMMM YYYY [à] HH[h]mm'), 'date_absolute' => $invitation->created_at->longAbsoluteDiffForHumans()]) !!}</p>

				<div class="columns-container">
					<form method="POST" action="{{ route('user.invitations.accept', ['invitation' => $invitation]) }}" class="column text-center">
						@csrf
						@method('POST')

						<button type="submit" class="button is-success">{{ __('Accepter') }}</button>
					</form>

					<form method="POST" action="{{ route('user.invitations.reject', ['invitation' => $invitation]) }}" class="column text-center">
						@csrf
						@method('DELETE')

						<button type="submit" class="button is-danger">{{ __('Refuser') }}</button>
					</form>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection
