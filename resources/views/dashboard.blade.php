@extends('layouts.app')

@section('content')
<header class="container">
	<h1>{{ __('Bienvenue, :name', ['name' => $user->name]) }}</h1>
	<p class="lead">Vous êtes membre {{ trans_choice('{0}d\'aucune association|{1}d\'une seule association|[2,*] {1} de {0} associations', $user->clubs_count) }}</p>
</header>

<div class="container">
	@if (session('status'))
	<div class="alert alert-success" role="alert">
		{{ session('status') }}
	</div>
	@endif

	@empty($clubs)
	<div class="alert alert-warning" role="alert">
		Vous ne faites partie d'aucune association
	</div>
	@else
	@foreach($clubs as $club)
	<div class="card">
		<h2 class="card-header">{{ $club->name }}</h2>

		<div class="card-body">
			<p>Vous êtes membre depuis <time datetime="{{ $club->pivot->created_at->toIso8601String() }}" title="Depuis le {{ $club->pivot->created_at->isoFormat('dddd DD MMMM YYYY [à] HH[h]mm') }}, pour être exact">{{ $club->pivot->created_at->longAbsoluteDiffForHumans() }}</time>.</p>

			@if($club->pivot->is_owner)
			<p class="alert alert-success" role="alert">Vous êtes gérant de cette association.</p>

			<p>{{ trans_choice('{1} Vous êtes le seul membre|[2,*] {1} membres dans l\'association', $club->members_count) }}.</p>

			<p>
				<a href="{{ @route('club.users', ['id' => $club->id]) }}" class="card-link">Liste des membres</a>
			</p>
			@endif
		</div>
	</div>
	@endforeach
	@endempty
</div>
@endsection
