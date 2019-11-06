@extends('layouts.app')

@section('content')
<header class="container">
	<h1>{{ __('Bienvenue, :name', ['name' => $user->name]) }}</h1>
	<p class="lead">Vous êtes membre {{ trans_choice('{0}d\'aucune association|{1}d\'une seule association|[2,*] de :count associations', count($user->clubs), ['count' => count($user->clubs)]) }}</p>
</header>

<div class="container">
	@if (session('status'))
	<div class="alert alert-success" role="alert">
		{{ session('status') }}
	</div>
	@endif

	@empty($user->clubs)
	<div class="alert alert-warning" role="alert">
		Vous ne faites partie d'aucune association
	</div>
	@endempty

	@foreach($user->clubs as $club)
	<div class="card">
		<h2 class="card-header">{{ $club->name }}</h2>

		<div class="card-body">
			@empty($club->sports)
			<p>Ne propose aucun sport</p>
			@else
			<p>
				Propose :
				@foreach($club->sports as $sport)
				<strong><a href="{{ route('clubs').'/'.$sport->slug }}">{{ $sport->name }}</a></strong>@if (!$loop->last),@endif
				@endforeach
			</p>
			@endempty

			<p>Vous êtes membre depuis <time datetime="{{ $club->pivot->created_at->toIso8601String() }}" title="Depuis le {{ $club->pivot->created_at->isoFormat('dddd DD MMMM YYYY [à] HH[h]mm') }}, pour être exact">{{ $club->pivot->created_at->longAbsoluteDiffForHumans() }}</time>.</p>

			@if($club->pivot->is_owner)
			<p class="alert alert-success" role="alert">Vous êtes gérant de cette association.</p>

			<p>{{ trans_choice('{1} Vous êtes le seul membre|[2,*] :count membres dans l\'association', $club->members_count, ['count' => $club->members_count]) }}.</p>
			@if(!empty($club->pending_members_count))
			<p>{{ trans_choice('{1} Une inscription en attente|[2,*] :count inscriptions en attente', $club->pending_members_count, ['count' => $club->pending_members_count]) }}.</p>
			@endif

			@empty($club->sites)
			<p>Aucun site</p>
			@else
			<ul>
				@foreach($club->sites as $site)
				<li><a href="https://{{ $site->domain }}">{{ $site->name }}</a></li>
				@endforeach
			</ul>
			@endempty
			@endif
		</div>
		@if($club->pivot->is_owner)
		<div class="card-footer text-center">
			<a href="{{ @route('club.members', ['club' => $club]) }}" class="btn btn-outline-primary">Liste des membres</a>
			<a href="{{ @route('club.edit', ['club' => $club]) }}" class="btn btn-outline-secondary">Modifier les informations</a>
		</div>
		@endif
	</div>
	@endforeach
</div>
@endsection
