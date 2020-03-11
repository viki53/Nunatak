@extends('layouts.dashboard')

@section('content')
<header class="hero">
	<h1 class="title">{{ $club->name }}</h1>
	<p class="subtitle">L'association {{ trans_choice('{0} ne gère aucun site|{1} gère un seul site|[2,*] gère :count sites', count($club->sites), ['count' => count($club->sites)]) }}</p>
</header>

<div class="columns-container">
	<div class="column">
		@foreach($club->sites as $site)
		<div class="card">
			<h2 class="card-header">{{ $site->title }}</h2>

			<div class="card-body">
				<div class="card-title"><a href="{{ $protocol }}://{{ $site->domain }}" target="_blank" title="{{ __('Ouvrir le site dans un nouvel onglet') }}">{{ $site->domain }}</a></div>

				<p><a href="{{ route('site.pages', ['site' => $site]) }}">Voir les pages</a></p>

				<form method="POST" action="{{ route('club.sites.remove', ['club' => $club, 'site' => $site]) }}">
					@csrf
					@method('DELETE')

					<button type="submit" class="btn btn-outline-danger float-right">{{ __('Supprimer') }}</button>

					<p>Créé <time datetime="{{ $site->created_at->toIso8601String() }}" title="Le {{ $site->created_at->isoFormat('dddd DD MMMM YYYY [à] HH[h]mm') }}, pour être exact">{{ $site->created_at->diffForHumans() }}</time>.</p>
				</form>
			</div>
		</div>
		@endforeach
	</div>
	<div class="column">
		<form method="POST" action="{{ route('club.sites.add', ['club' => $club]) }}" class="card">
			@csrf

			<h2 class="card-header">Créer un nouveau site</h2>

			<div class="card-body">
				<div class="form-group row">
					<label for="new-site-title" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

					<div class="col-md-6">
						<input id="new-site-title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $club->name) }}" required autocomplete="off">

						@error('sport_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>

				<div class="form-group row">
					<label for="new-site-domain" class="col-md-4 col-form-label text-md-right">{{ __('Nom de domaine') }}</label>

					<div class="col-md-6">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">https://</span>
							</div>
							<input id="new-site-domain" type="text" class="form-control @error('domain') is-invalid @enderror" name="domain" value="{{ old('domain', Str::slug($club->name)) }}" required autocomplete="off">
							<div class="input-group-append">
								<span class="input-group-text">{{ config('nunatak.domain_suffix') }}</span>
							</div>
						</div>

						@error('sport_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>

				<div class="form-group row mb-0">
					<div class="col-md-6 offset-md-4">
						<button type="submit" class="btn btn-primary">
							{{ __('Créer') }}
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
