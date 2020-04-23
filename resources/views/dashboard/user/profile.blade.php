@extends('layouts.dashboard')

@section('hero')
<header class="hero">
	<h1 class="title">Profil</h1>
	<p class="subtitle">{{ __('Bienvenue, :name', ['name' => $user->name]) }}</p>
</header>
@endsection

@section('content')
<form method="POST" action="{{ route('user.profile') }}">
	@csrf

	<div class="columns-container">
		<div class="column col-md-4">
			<div class="card">
				<label for="profile-name" class="card-header">{{ __('Nom complet') }}</label>

				<div class="card-body">
					<div class="form-group">
						<input id="profile-name" type="text" class="input @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

						@error('name')
						<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
						@enderror
					</div>
				</div>
			</div>
		</div>

		<div class="column col-md-4">
			<div class="card">
				<label for="profile-email" class="card-header">{{ __('Adresse email') }}</label>

				<div class="card-body">
					<div class="form-group">
						<input id="profile-email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

						@error('email')
						<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
						@enderror
					</div>
				</div>
			</div>
		</div>

		<div class="column col-md-4">
			<div class="card">
				<label for="profile-phone" class="card-header">{{ __('Numéro de téléphone') }}</label>

				<div class="card-body">
					<div class="form-group">
						<input id="profile-phone" type="tel" class="input @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}" required autocomplete="tel">

						@error('phone')
						<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
						@enderror
					</div>
				</div>
			</div>
		</div>

		<div class="column col-12">
			<div class="form-group submit">
				<button type="submit" class="button">{{ __('Enregistrer') }}</button>
			</div>
		</div>
	</div>
</form>
@endsection
