@extends('layouts.dashboard')

@section('content')
<header class="hero">
	<h1 class="title">Mot de passe</h1>
	<p class="subtitle">{{ __('Bienvenue, :name', ['name' => $user->name]) }}</p>
</header>

<form method="POST" action="{{ route('user.password') }}">
	@csrf

	<div class="columns-container">
		<div class="column col-sm">
			<div class="form-group">
				<label for="old_password" class="label">{{ __('Ancien mot de passe') }}</label>

				<input id="old_password" type="password" class="input @error('old_password') is-invalid @enderror" name="old_password" required autocomplete="password" autofocus>

				@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
		</div>

		<div class="column col-sm">
			<div class="form-group">
				<label for="password" class="label">{{ __('Nouveau mot de passe') }}</label>

				<input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" autofocus>

				@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
		</div>

		<div class="column col-sm">
			<div class="form-group">
				<label for="password-confirm" class="label">{{ __('Confirmer le mot de passe') }}</label>

				<input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">

				@error('password_confirmation')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
		</div>
	</div>

	<div class="columns-container">
		<div class="column">
			<div class="form-group submit">
				<button type="submit" class="button">{{ __('Changer de mot de passe') }}</button>
			</div>
		</div>
	</div>
</form>
@endsection
