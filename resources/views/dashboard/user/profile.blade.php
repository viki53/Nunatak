@extends('layouts.dashboard')

@section('content')
<header class="hero">
	<h1 class="title">Profil</h1>
	<p class="subtitle">{{ __('Bienvenue, :name', ['name' => $user->name]) }}</p>
</header>

<form method="POST" action="{{ route('user.profile') }}">
	@csrf

	<div class="columns-container">
		<div class="column col-sm">
			<div class="form-group">
				<label for="profile-name" class="label">{{ __('Nom complet') }}</label>

				<input id="profile-name" type="text" class="input @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

				@error('name')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>

		<div class="column col-sm">
			<div class="form-group">
				<label for="profile-email" class="label">{{ __('Adresse email') }}</label>

				<input id="profile-email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

				@error('email')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>

		<div class="column col-sm">
			<div class="form-group">
				<label for="profile-phone" class="label">{{ __('Numéro de téléphone') }}</label>

				<input id="profile-phone" type="tel" class="input @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}" required autocomplete="tel">

				@error('phone')
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
				<button type="submit" class="button">{{ __('Enregistrer') }}</button>
			</div>
		</div>
	</div>
</form>
@endsection
