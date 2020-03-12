@extends('layouts.dashboard')

@section('content')
<header class="hero">
	<h1 class="title">{{ $site->title }}</h1>
	<p class="subtitle">Modifier une page <q>{{ $page->last_revision->title }}</q></p>
</header>

<form method="POST" action="{{ route('site.pages.update', ['site' => $site, 'page' => $page]) }}">
	@csrf

	<fieldset class="columns-container">
		<div class="column">

			<div class="form-group">
				<label for="new-page-title" class="col-md-4 col-form-label text-md-right">{{ __('Titre') }}</label>

				<input id="new-page-title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" required value="{{ old('title', $page->last_revision->title) }}" required autofocus>

				@error('title')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>

			<div class="form-group">
				<label for="new-page-subtitle" class="col-md-4 col-form-label text-md-right">{{ __('Sous-titre') }}</label>

				<input id="new-page-subtitle" type="text" class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" value="{{ old('subtitle', $page->last_revision->subtitle) }}" required>

				@error('subtitle')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
		</div>

		<div class="column">
			<div class="form-group">
				<label for="new-page-path" class="col-md-4 col-form-label text-md-right">{{ __('Chemin') }}</label>

				<input id="new-page-path" type="text" class="form-control @error('path') is-invalid @enderror" name="path" value="{{ old('path', $page->path) }}" required>

				@error('path')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
		</div>
	</fieldset>

	<fieldset class="columns-container">
		<div class="column">
			<h3><label for="new-page-content">{{ __('Contenu') }}</label></h3>

			<div class="form-group">
				<textarea id="new-page-content" data-text-editor class="form-control @error('content') is-invalid @enderror" name="content" required>{{ old('content', $page->last_revision->content) }}</textarea>

				@error('content')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>

			<div class="form-group submit">
				<button type="submit" class="button-primary">
					{{ !empty($page) ? __('Enregistrer') : __('Créer') }}
				</button>
			</div>
		</div>
	</fieldset>
</form>
@endsection
