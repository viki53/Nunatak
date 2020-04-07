@extends('layouts.public')

@section('content')
<div class="container small">
	<div class="card">
		<h1 class="card-header">{{ __('Connexion') }}</h1>

		<div class="card-body">
			<form method="POST" action="{{ route('login') }}">
				@csrf

				<div class="form-group">
					<label for="email" class="label">{{ __('Adresse email') }}</label>

					<input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

					@error('email')
					<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
					@enderror
				</div>

				<div class="form-group">
					<label for="password" class="label">{{ __('Mot de passe') }}</label>

					<input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

					@error('password')
					<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
					@enderror
				</div>

				<div class="form-group">
					<div class="checkbox-container">
						<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

						<label for="remember">
							{{ __('Se souvenir de moi') }}
						</label>
					</div>
				</div>

				<div class="form-group submit">
					@if (Route::has('password.request'))
					<a class="button is-link" href="{{ route('password.request') }}">{{ __('Mot de passe oublié ?') }}</a>
					@endif

					<button type="submit" class="button">{{ __('Connexion') }}</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
