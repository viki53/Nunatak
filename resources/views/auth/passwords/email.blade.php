@extends('layouts.public')

@section('content')
<div class="container small">
	<div class="card">
		<h1 class="card-header">{{ __('Réinitialiser le mot de passe') }}</h1>

		<form method="POST" action="{{ route('password.email') }}" class="card-body">
			@csrf

			@if (session('status'))
			<p class="alert is-success" role="alert">{{ session('status') }}</p>
			@endif

			<div class="form-group">
				<label for="email" class="label">{{ __('Adresse email') }}</label>

				<input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

				@error('email')
				<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
				@enderror
			</div>

			<div class="form-group submit">
				<button type="submit" class="button">{{ __('Envoyer le lien de réinitialisation') }}</button>
			</div>
		</form>
	</div>
</div>
@endsection
