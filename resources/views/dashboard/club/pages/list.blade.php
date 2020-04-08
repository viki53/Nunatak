@extends('layouts.dashboard')

@section('hero')
<header class="hero">
	<h1 class="title">{{ $site->title }}</h1>
	<p class="subtitle">{{ trans_choice('{0} Ce site ne comporte aucune page|{1} Ce site comporte une seule page|[2,*] Ce site comporte :count pages', count($site->pages), ['count' => count($site->pages)]) }}</p>
</header>
@endsection

@section('content')
<div class="columns-container">
	<div class="column col-lg">
		<div class="card">
			<h2 class="card-header">{{ __('Liste des pages') }}</h2>

			<div class="card-body">
				@if(empty($site->home_page))
				<p class="alert is-warning" role="alert">{{ __('Ce site n\'a pas de page d\'accueil') }}</p>
				@endif

				@if(empty($site->error404_page))
				<p class="alert is-info" role="alert">{!! __('Vous pouvez créer une page d\'erreur 404 personnalisée en indiquant le chemin <strong>/404</strong>.') !!}</p>
				@endif

				@if(!empty($site->pages))
				<table class="simple striped">
					<thead>
						<tr>
							<th>{{ __('Page') }}</th>
							<th class="text-center" style="width: 7rem"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($site->pages as $page)
						<tr>
							<td>
								<p>
									<strong>
										@can('update', $page)
										<a href="{{ route('site.pages.edit', ['site' => $site, 'page' => $page]) }}">{{ $page->last_revision->title }}</a>
										@else
										{{ $page->last_revision->title }}
										@endcan
									</strong>

									@if($page->isHomePage)
									<span class="tag is-info">{{ __('Accueil') }}</span>
									@elseif($page->isError404Page)
									<span class="tag is-info">{{ __('Erreur 404') }}</span>
									@endif
								</p>

								<p>{!! __('Dernière modification <time datetime=":date_iso" title="Le :date_formatted, pour être exact">:date_absolute</time>', ['date_iso' => $page->last_revision->created_at->toIso8601String(), 'date_formatted' => $page->last_revision->created_at->isoFormat('dddd D MMMM YYYY [à] HH[h]mm'), 'date_absolute' => $page->last_revision->created_at->diffForHumans()]) !!}</p>
							</td>

							<td class="text-center">
								@if(!$page->isHomePage)
								<form method="POST" action="{{ route('site.pages.remove', ['site' => $site, 'page' => $page]) }}">
									@csrf
									@method('DELETE')

									<button type="submit" class="button is-danger">{{ __('Supprimer') }}</button>
								</form>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@endif
			</div>
		</div>
	</div>

	@can('create_page', $site)
	<div class="column col-sm">
		<form method="POST" action="{{ route('site.pages.add', ['site' => $site]) }}" class="card">
			@csrf

			<h2 class="card-header">{{ __('Créer une nouvelle page') }}</h2>

			<div class="card-body">
				<div class="form-group">
					<label for="new-page-title" class="label">{{ __('Titre') }}</label>

					<input id="new-page-title" type="text" class="input @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>

					@error('title')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="new-page-path" class="label">{{ __('Chemin') }}</label>

					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">{{ $site->domain}}</span>
						</div>
						<input id="new-page-path" type="text" class="input @error('path') is-invalid @enderror" name="path" value="{{ old('path', '/') }}" required>
					</div>

					@error('path')
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
