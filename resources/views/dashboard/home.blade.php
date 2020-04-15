@extends('layouts.dashboard')

@section('hero')
<header class="hero">
	<h1 class="title">{{ __('Bienvenue, :name', ['name' => $user->name]) }}</h1>
	<p class="subtitle">{{ trans_choice('{0}Vous êtes membre d\'aucune association|{1}Vous êtes membre d\'une seule association|[2,*]Vous êtes membre de :count associations', count($user->clubs), ['count' => count($user->clubs)]) }}</p>
</header>
@endsection

@section('content')
<div class="columns-container">
	<div class="column">
		@empty($user->clubs)
		<p class="alert is-warning" role="alert">
			{{ __('Vous ne faites partie d\'aucune association') }}
		</p>
		@endempty

		@foreach($user->clubs as $club)
		<div class="card">
			<h2 class="card-header">{{ $club->name }}</h2>

			<div class="card-body">
				@if(!count($club->sports))
				<p class="alert is-warning" role="alert">{{ __('Ne propose aucun sport') }}</p>
				@else
				<p>
					{{ __('Propose :') }}
					@foreach($club->sports as $sport)
					<a href="{{ route('clubs').'/'.$sport->slug }}" class="tag is-secondary">{{ $sport->name }}</a>@if (!$loop->last)<span class="sr-only">,</span>@endif
					@endforeach
				</p>
				@endif

				@if(!count($club->sites))
				<p class="alert is-warning" role="alert">{{ __('Aucun site') }}</p>
				@else
				<p>{{ trans_choice('{1} Un site public|[2,*] :count sites publics', count($club->sites), ['count' => count($club->sites)]) }} :</p>
				<ul>
					@foreach($club->sites as $site)
					<li><a href="{{ $protocol }}://{{ $site->domain }}" target="_blank" title="{{ __('Ouvrir le site dans un nouvel onglet') }}">{{ $site->title }}</a> <a href="{{ route('site.pages', ['site' => $site]) }}" class="tag is-info">{{ __('Gérer') }}</a></li>
					@endforeach
				</ul>
				@endif

				<p>{!! __('Vous êtes membre depuis <time datetime=":date_iso" title="Depuis le :date_formatted, pour être exact">:date_absolute</time>', ['date_iso' => $club->pivot->created_at->toIso8601String(), 'date_formatted' => $club->pivot->created_at->isoFormat('dddd D MMMM YYYY [à] HH[h]mm'), 'date_absolute' => $club->pivot->created_at->longAbsoluteDiffForHumans()]) !!}</p>

				@if($club->pivot->is_owner)
				<p class="alert is-success" role="alert">{{ __('Vous êtes gérant de cette association') }}</p>

				<p>{{ trans_choice('{1} Vous êtes le seul membre|[2,*] :count membres dans l\'association', $club->members_count, ['count' => $club->members_count]) }}</p>
				@if(!empty($club->invitations_count))
				<p>{{ trans_choice('{1} Une inscription en attente|[2,*] :count inscriptions en attente', $club->invitations_count, ['count' => $club->invitations_count]) }}</p>
				@endif
				@endif
			</div>
			@if($club->pivot->is_owner)
			<div class="card-footer text-center">
				<a href="{{ @route('club.members', ['club' => $club]) }}">{{ __('Liste des membres') }}</a>
				<a href="{{ @route('club.edit', ['club' => $club]) }}">{{ __('Modifier les informations') }}</a>
			</div>
			@endif
		</div>
		@endforeach
	</div>
</div>
@endsection
