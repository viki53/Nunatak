@extends('layouts.app')

@section('content')
<header class="container">
	<h1>{{ $site->title }}</h1>
	<p class="lead">Modifier la page {{ $page->last_revision->title }}</p>
</header>

<div class="container">
	<div class="row">
		@include('club.menu', ['club' => $site->club])
		<div class="col-md-9">
			@if (session('status'))
			<div class="alert alert-success" role="alert">
				{{ session('status') }}
			</div>
			@endif

			<form method="POST" action="{{ route('site.pages.update', ['site' => $site, 'page' => $page]) }}" class="card">
				@csrf

				<h2 class="card-header">Modifier la page</h2>

				<div class="card-body">
					<div class="form-group row">
						<label for="new-page-title" class="col-md-4 col-form-label text-md-right">{{ __('Titre') }}</label>

						<div class="col-md-6">
							<input id="new-page-title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $page->last_revision->title) }}" required autofocus>

							@error('title')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<label for="new-page-subtitle" class="col-md-4 col-form-label text-md-right">{{ __('Sous-titre') }}</label>

						<div class="col-md-6">
							<input id="new-page-subtitle" type="text" class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" value="{{ old('subtitle', $page->last_revision->subtitle) }}" required>

							@error('subtitle')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<label for="new-page-content" class="col-md-4 col-form-label text-md-right">{{ __('Contenu') }}</label>

						<div class="col-md-6">
							<textarea id="new-page-content" class="form-control @error('content') is-invalid @enderror" name="content" required>{{ old('content', $page->last_revision->content) }}</textarea>

							@error('content')
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
</div>
@endsection
