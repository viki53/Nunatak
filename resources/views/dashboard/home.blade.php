@extends('layouts.dashboard')

@section('content')
<header class="hero">
	<h1 class="title">{{ __('Bienvenue, :name', ['name' => $user->name]) }}</h1>
	<p class="subtitle">Vous êtes membre {{ trans_choice('{0}d\'aucune association|{1}d\'une seule association|[2,*] de :count associations', count($user->clubs), ['count' => count($user->clubs)]) }}</p>
</header>

<div class="columns-container">
	<div class="column">
		@if (session('status'))
		<div class="alert alert-success" role="alert">
			{{ session('status') }}
		</div>
		@endif

		@empty($user->clubs)
		<div class="alert alert-warning" role="alert">
			{{ __('Vous ne faites partie d\'aucune association') }}
		</div>
		@endempty

		@foreach($user->clubs as $club)
		<div class="card">
			<h2 class="card-header">{{ $club->name }}</h2>

			<div class="card-body">
				@if(count($club->sports) === 0)
				<p>{{ __('Ne propose aucun sport') }}</p>
				@else
				<p>
					{{ __('Propose :') }}
					@foreach($club->sports as $sport)
					<strong><a href="{{ route('clubs').'/'.$sport->slug }}">{{ $sport->name }}</a></strong>@if (!$loop->last),@endif
					@endforeach
				</p>
				@endif

				@if(count($club->sites) === 0)
				<p>Aucun site</p>
				@else
				<p>{{ trans_choice('{1} Un seul site public|[2,*] :count sites publics', count($club->sites), ['count' => count($club->sites)]) }} :</p>
				<ul>
					@foreach($club->sites as $site)
					<li><a href="{{ $protocol }}://{{ $site->domain }}" target="_blank" title="{{ __('Ouvrir le site dans un nouvel onglet') }}">{{ $site->title }}</a> <a href="{{ route('site.pages', ['site' => $site]) }}" class="btn btn-outline-primary btn-sm">Gérer</a></li>
					@endforeach
				</ul>
				@endif

				<p>Vous êtes membre depuis <time datetime="{{ $club->pivot->created_at->toIso8601String() }}" title="Depuis le {{ $club->pivot->created_at->isoFormat('dddd DD MMMM YYYY [à] HH[h]mm') }}, pour être exact">{{ $club->pivot->created_at->longAbsoluteDiffForHumans() }}</time>.</p>

				@if($club->pivot->is_owner)
				<p class="alert alert-success" role="alert">{{ __('Vous êtes gérant de cette association') }}</p>

				<p>{{ trans_choice('{1} Vous êtes le seul membre|[2,*] :count membres dans l\'association', $club->members_count, ['count' => $club->members_count]) }}.</p>
				@if(!empty($club->invitations_count))
				<p>{{ trans_choice('{1} Une inscription en attente|[2,*] :count inscriptions en attente', $club->invitations_count, ['count' => $club->invitations_count]) }}.</p>
				@endif
				@endif
			</div>
			@if($club->pivot->is_owner)
			<div class="card-footer text-center">
				<a href="{{ @route('club.members', ['club' => $club]) }}" class="btn btn-outline-primary">{{ __('Liste des membres') }}</a>
				<a href="{{ @route('club.edit', ['club' => $club]) }}" class="btn btn-outline-secondary">Modifier les informations</a>
			</div>
			@endif
		</div>
		@endforeach
	</div>
</div>
@endsection
