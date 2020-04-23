@extends('layouts.dashboard')

@section('hero')
<header class="hero">
	<h1 class="title">{{ $site->title }}</h1>
	<p class="subtitle">{!! __('Modifier la page <q>:page_title</q>', ['page_title' => e($page->last_revision->title)]) !!} <a href="{{ $protocol }}://{{ $site->domain }}{{ $page->path }}" target="_blank" title="{{ __('Ouvrir le site dans un nouvel onglet') }}" class="tag is-primary">{{ __('Voir') }}</a></p>
</header>
@endsection

@section('content')
<form method="POST" action="{{ route('site.pages.update', ['site' => $site, 'page' => $page]) }}" class="columns-container">
	@csrf

	<fieldset class="column col-md-8">
		<div class="card">
			<label for="edit-page-content" class="card-header">{{ __('Contenu') }}</label>

			<div class="card-body">
				<div class="form-group">
					<textarea id="edit-page-content" data-text-editor class="textarea @error('content') is-invalid @enderror" name="content" required>{{ old('content', $page->last_revision->content) }}</textarea>

					@error('content')
					<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
					@enderror
				</div>
			</div>
		</div>
	</fieldset>

	<fieldset class="column col-md-4">
		<div class="card">
			<label for="edit-page-title" class="card-header">{{ __('Titre') }}</label>

			<div class="card-body">
				<div class="form-group">
					<input id="edit-page-title" type="text" class="input @error('title') is-invalid @enderror" name="title" required value="{{ old('title', $page->last_revision->title) }}" required autofocus>

					@error('title')
					<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
					@enderror
				</div>
			</div>
		</div>

		<div class="card">
			<label for="edit-page-subtitle" class="card-header">{{ __('Sous-titre') }}</label>

			<div class="card-body">
				<div class="form-group">
					<input id="edit-page-subtitle" type="text" class="input @error('subtitle') is-invalid @enderror" name="subtitle" value="{{ old('subtitle', $page->last_revision->subtitle) }}" required>

					@error('subtitle')
					<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
					@enderror
				</div>
			</div>
		</div>

		<div class="card">
			<label for="edit-page-path" class="card-header">{{ __('Chemin') }}</label>

			<div class="card-body">
				<div class="form-group">
					<input id="edit-page-path" type="text" class="input @error('path') is-invalid @enderror" name="path" value="{{ old('path', $page->path) }}" placeholder="{{ $site->domain}}" required>

					@error('path')
					<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
					@enderror
				</div>
			</div>
		</div>

		<div class="form-group submit">
			<button type="submit" class="button">{{ !empty($page) ? __('Enregistrer') : __('Créer') }}</button>
		</div>
	</fieldset>
</form>
@endsection
