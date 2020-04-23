@extends('layouts.public')

@section('content')
<div class="container small">
	<div class="card">
		<h1 class="card-header">{{ __('Inscription') }}</h1>

		<div class="card-body">
			<form method="POST" action="{{ route('register') }}">
				@csrf

				<div class="form-group">
					<label for="name" class="label">{{ __('Nom') }}</label>

					<input id="name" type="text" class="input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

					@error('name')
					<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
					@enderror
				</div>

				<div class="form-group">
					<label for="email" class="label">{{ __('Adresse email') }}</label>

					<input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
				</div>

				<div class="form-group submit">
					<button type="submit" class="button">{{ __('Inscription') }}</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
