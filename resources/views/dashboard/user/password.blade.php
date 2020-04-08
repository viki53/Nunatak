@extends('layouts.dashboard')

@section('hero')
<header class="hero">
	<h1 class="title">Mot de passe</h1>
	<p class="subtitle">{{ __('Bienvenue, :name', ['name' => $user->name]) }}</p>
</header>
@endsection

@section('content')
<form method="POST" action="{{ route('user.password') }}">
	@csrf

	<div class="columns-container">
		<div class="column col-sm">
			<div class="card">
				<label for="old_password" class="card-header">{{ __('Ancien mot de passe') }}</label>

				<div class="card-body">
					<div class="form-group">

						<input id="old_password" type="password" class="input @error('old_password') is-invalid @enderror" name="old_password" required autocomplete="password" autofocus>

						@error('password')
						<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
						@enderror
					</div>
				</div>
			</div>
		</div>

		<div class="column col-sm">
			<div class="card">
				<label for="password" class="card-header">{{ __('Nouveau mot de passe') }}</label>

				<div class="card-body">
					<div class="form-group">

						<input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" autofocus>

						@error('password')
						<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
						@enderror
					</div>
				</div>
			</div>
		</div>

		<div class="column col-sm">
			<div class="card">
				<label for="password-confirm" class="card-header">{{ __('Confirmer le mot de passe') }}</label>

				<div class="card-body">
					<div class="form-group">

						<input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">

						@error('password_confirmation')
						<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
						@enderror
					</div>
				</div>
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
