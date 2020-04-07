@extends('layouts.public')

@section('content')
<div class="container small">
	<div class="card">
		<h1 class="card-header">{{ __('Réinitialiser le mot de passe') }}</h1>

		<form method="POST" action="{{ route('password.update') }}" class="card-body">
			@csrf

			<input type="hidden" name="token" value="{{ $token }}">

			<div class="form-group">
				<label for="email" class="label">{{ __('Adresse email') }}</label>

				<input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

				@error('email')
				<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
				@enderror
			</div>

			<div class="form-group">
				<label for="password" class="label">{{ __('Mot de passe') }}</label>

				<input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

				@error('password')
				<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
				@enderror
			</div>

			<div class="form-group">
				<label for="password-confirm" class="label">{{ __('Confirmer le mot de passe') }}</label>

				<input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">

				@error('password_confirmation')
				<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
				@enderror
			</div>

			<div class="form-group submit">
				<button type="submit" class="button">{{ __('Réinitialiser le mot de passe') }}</button>
			</div>
		</form>
	</div>
</div>
@endsection
