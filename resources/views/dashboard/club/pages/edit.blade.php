@extends('layouts.dashboard')

@section('content')
<header class="hero">
	<h1 class="title">{{ $site->title }}</h1>
	<p class="subtitle">{!! __('Modifier la page <q>:page_title</q>', ['page_title' => e($page->last_revision->title)]) !!}</p>
</header>

<form method="POST" action="{{ route('site.pages.update', ['site' => $site, 'page' => $page]) }}" class="columns-container">
	@csrf

	<fieldset class="column col-lg">
		<div class="card">
			<label for="new-page-content" class="card-header">{{ __('Contenu') }}</label>

			<div class="card-body">
				<div class="form-group">
					<textarea id="new-page-content" data-text-editor class="textarea @error('content') is-invalid @enderror" name="content" required>{{ old('content', $page->last_revision->content) }}</textarea>

					@error('content')
					<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
					@enderror
				</div>
			</div>
		</div>
	</fieldset>

	<fieldset class="column col-sm">
		<div class="card">
			<label for="new-page-title" class="card-header">{{ __('Titre') }}</label>

			<div class="card-body">
				<div class="form-group">
					<input id="new-page-title" type="text" class="input @error('title') is-invalid @enderror" name="title" required value="{{ old('title', $page->last_revision->title) }}" required autofocus>

					@error('title')
					<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
					@enderror
				</div>
			</div>
		</div>

		<div class="card">
			<label for="new-page-subtitle" class="card-header">{{ __('Sous-titre') }}</label>

			<div class="card-body">
				<div class="form-group">
					<input id="new-page-subtitle" type="text" class="input @error('subtitle') is-invalid @enderror" name="subtitle" value="{{ old('subtitle', $page->last_revision->subtitle) }}" required>

					@error('subtitle')
					<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
					@enderror
				</div>
			</div>
		</div>

		<div class="card">
			<label for="new-page-path" class="card-header">{{ __('Chemin') }}</label>

			<div class="card-body">
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">{{ $site->domain}}</span>
						</div>
						<input id="new-page-path" type="text" class="input @error('path') is-invalid @enderror" name="path" value="{{ old('path', $page->path) }}" required>
					</div>

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
