@extends('layouts.dashboard')

@section('content')
<header class="hero">
	<h1 class="title">{{ $site->title }}</h1>
	<p class="subtitle">Ce site {{ trans_choice('{0} ne comporte aucune page|{1} comporte une seule page|[2,*] comporte :count pages', count($site->pages), ['count' => count($site->pages)]) }}</p>
</header>

<div class="columns-container">
	<div class="column">
		@if(empty($site->home_page))
		<p class="alert warning" role="alert">
			{{ __('Votre site n\'a pas de page d\'accueil') }}
		</p>
		@endif

		@if(!empty($site->pages))
		<table class="simple striped">
			<thead>
				<tr>
					<th>Page</th>
					<th>Chemin</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($site->pages as $page)
				<tr>
					<td>
						<p>
							<strong>
								@can('update', $page)
								<a href="{{ route('site.pages.edit', ['site' => $site, 'page' => $page]) }}">
									{{ $page->last_revision->title }}
								</a>
								@else
								{{ $page->last_revision->title }}
								@endcan
							</strong>
						</p>

						<p>Créée <time datetime="{{ $page->created_at->toIso8601String() }}" title="Le {{ $page->created_at->isoFormat('dddd DD MMMM YYYY [à] HH[h]mm') }}, pour être exact">{{ $page->created_at->diffForHumans() }}</time>.</p>
						<p>Dernière modification <time datetime="{{ $page->created_at->toIso8601String() }}" title="Le {{ $page->last_revision->created_at->isoFormat('dddd DD MMMM YYYY [à] HH[h]mm') }}, pour être exact">{{ $page->last_revision->created_at->diffForHumans() }}</time>.</p>
					</td>

					<td>
						<p>
							<a href="{{ $protocol }}://{{ $site->domain }}{{ $page->path }}" target="_blank" title="{{ __('Ouvrir la page dans un nouvel onglet') }}">
								{{ $page->path }}
							</a>
						</p>
					</td>

					<td>
						@if(!empty($site->home_page) && $page->id !== $site->home_page->id)
						<form method="POST" action="{{ route('site.pages.remove', ['site' => $site, 'page' => $page]) }}" class="float-right mx-1">
							@csrf
							@method('DELETE')

							<button type="submit" class="btn btn-outline-danger">{{ __('Supprimer') }}</button>
						</form>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@endif
	</div>

	@can('create_page', $site)
	<form method="POST" action="{{ route('site.pages.add', ['site' => $site]) }}" class="column">
		@csrf

		<h2>Créer une nouvelle page</h2>

		<div class="form-group row">
			<label for="new-page-title" class="col-md-4 col-form-label text-md-right">{{ __('Titre') }}</label>

			<input id="new-page-title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>

			@error('title')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>

		<div class="form-group row">
			<label for="new-page-path" class="col-md-4 col-form-label text-md-right">{{ __('Chemin') }}</label>

			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text">{{ $site->domain}}</span>
				</div>
				<input id="new-page-path" type="text" class="form-control @error('path') is-invalid @enderror" name="path" value="{{ old('path', '/') }}" required>
			</div>

			@error('path')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>

		<div class="form-group submit">
			<button type="submit" class="button-primary">
				{{ __('Créer') }}
			</button>
		</div>
	</form>
	@endcan
</div>

@endsection
