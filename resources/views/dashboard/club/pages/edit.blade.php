@extends('layouts.dashboard')

@section('content')
<header class="hero">
	<h1 class="title">{{ $site->title }}</h1>
	<p class="subtitle">{!! __('Modifier la page <q>:page_title</q>', ['page_title' => e($page->last_revision->title)]) !!}</p>
</header>

<form method="POST" action="{{ route('site.pages.update', ['site' => $site, 'page' => $page]) }}" class="columns-container">
	@csrf

	<fieldset class="column col-sm">
		<div class="form-group">
			<label for="new-page-title" class="label">{{ __('Titre') }}</label>

			<input id="new-page-title" type="text" class="input @error('title') is-invalid @enderror" name="title" required value="{{ old('title', $page->last_revision->title) }}" required autofocus>

			@error('title')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>

		<div class="form-group">
			<label for="new-page-subtitle" class="label">{{ __('Sous-titre') }}</label>

			<input id="new-page-subtitle" type="text" class="input @error('subtitle') is-invalid @enderror" name="subtitle" value="{{ old('subtitle', $page->last_revision->subtitle) }}" required>

			@error('subtitle')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>

		<div class="form-group">
			<label for="new-page-path" class="label">{{ __('Chemin') }}</label>

			<input id="new-page-path" type="text" class="input @error('path') is-invalid @enderror" name="path" value="{{ old('path', $page->path) }}" required>

			@error('path')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
	</fieldset>

	<fieldset class="column col-lg">
		<label for="new-page-content" class="label">{{ __('Contenu') }}</label>

		<div class="form-group">
			<textarea id="new-page-content" data-text-editor class="textarea @error('content') is-invalid @enderror" name="content" required>{{ old('content', $page->last_revision->content) }}</textarea>

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
	</fieldset>
</form>
@endsection
