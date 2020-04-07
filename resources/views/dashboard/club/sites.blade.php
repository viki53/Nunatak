@extends('layouts.dashboard')

@section('content')
<header class="hero">
	<h1 class="title">{{ $club->name }}</h1>
	<p class="subtitle">{{ trans_choice('{0} L\'association ne gère aucun site|{1} L\'association gère un seul site|[2,*] L\'association gère :count sites', count($club->sites), ['count' => count($club->sites)]) }}</p>
</header>

<div class="columns-container">
	@if(count($club->sites) > 0)
	<div class="column col-lg">
		<div class="card">
			<h2 class="card-header">{{ __('Liste des sites') }}</h2>

			<div class="card-body">
				<table class="simple striped">
					<thead>
						<tr>
							<th>{{ __('Site') }}</th>
							<th class="text-center" style="width: 12rem">{{ __('Pages') }}</th>
							<th class="text-center" style="width: 9rem"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($club->sites as $site)
						<tr>
							<td>
								<p><strong>{{ $site->title }}</strong></p>

								<p><em><a href="{{ $protocol }}://{{ $site->domain }}" target="_blank" title="{{ __('Ouvrir le site dans un nouvel onglet') }}">{{ $site->domain }}</a></em></p>
								@if(empty($site->home_page))
								<p class="alert is-warning" role="alert">{{ __('Ce site n\'a pas de page d\'accueil') }}</p>
								@endif
							</td>

							<td class="text-center">
								<p>
									<a href="{{ route('site.pages', ['site' => $site]) }}">{{ trans_choice('{0} Aucune page|{1} Une seule page|[2,*] :count pages', $site->pages_count, ['count' => $site->pages_count]) }}</a>
								</p>
							</td>

							<td class="text-center">
								<form method="POST" action="{{ route('club.sites.remove', ['club' => $club, 'site' => $site]) }}">
									@csrf
									@method('DELETE')

									<button type="submit" class="button is-danger">{{ __('Supprimer') }}</button>

									<p>{!! __('Créé <time datetime=":date_iso" title="Le :date_formatted, pour être exact">il y a :date_absolute</time>', ['date_iso' => $site->created_at->toIso8601String(), 'date_formatted' => $site->created_at->isoFormat('dddd D MMMM YYYY [à] HH[h]mm'), 'date_absolute' => $site->created_at->longAbsoluteDiffForHumans()]) !!}</p>
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@endif

	@can('create_site', $club)
	<div class="column col-sm">
		<form method="POST" action="{{ route('club.sites.add', ['club' => $club]) }}" class="card">
			@csrf

			<h2 class="card-header">Créer un nouveau site</h2>

			<div class="card-body">
				<div class="form-group">
					<label for="new-site-title" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

					<input id="new-site-title" type="text" class="input @error('title') is-invalid @enderror" name="title" value="{{ old('title', $club->name) }}" required autocomplete="off">

					@error('title')
					<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
					@enderror
				</div>

				<div class="form-group">
					<label for="new-site-domain" class="col-md-4 col-form-label text-md-right">{{ __('Nom de domaine') }}</label>

					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">https://</span>
						</div>
						<input id="new-site-domain" type="text" class="input @error('domain') is-invalid @enderror" name="domain" value="{{ old('domain', Str::slug($club->name)) }}" required autocomplete="off">
						<div class="input-group-append">
							<span class="input-group-text">{{ config('nunatak.domain_suffix') }}</span>
						</div>
					</div>

					@error('domain')
					<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
					@enderror
				</div>

				<div class="form-group submit">
					<button type="submit" class="button">{{ __('Créer') }}</button>
				</div>
			</div>
		</form>
	</div>
	@endcan
</div>
@endsection
