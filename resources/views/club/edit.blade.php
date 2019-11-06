@extends('layouts.app')

@section('content')
<header class="container">
	<h1>{{ $club->name }}</h1>
	<p class="lead">Existe depuis <time datetime="{{ $club->created_at->toIso8601String() }}" title="Depuis le {{ $club->created_at->isoFormat('dddd DD MMMM YYYY [à] HH[h]mm') }}, pour être exact">{{ $club->created_at->longAbsoluteDiffForHumans() }}</time></p>
</header>

<div class="container">
	<div class="row">
		@include('club.menu', ['club' => $club])
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">{{ __('Modifier le club sportif') }}</div>

				<div class="card-body">
					<form method="POST" action="{{ route('club.update', ['club' => $club]) }}">
						@csrf

						<div class="form-group row">
							<label for="club-name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

							<div class="col-md-6">
								<input id="club-name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $club->name) }}" required autocomplete="organization" autofocus>

								@error('name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="club-address" class="col-md-4 col-form-label text-md-right">{{ __('Adresse') }}</label>

							<div class="col-md-6">
								<textarea id="club-address" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="street-address">{{ old('address', $club->address) }}</textarea>

								@error('address')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="club-city" class="col-md-4 col-form-label text-md-right">{{ __('Ville') }}</label>

							<div class="col-md-6">
								<input id="club-city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city', $club->city) }}" required autocomplete="city">

								@error('city')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="club-country" class="col-md-4 col-form-label text-md-right">{{ __('Pays') }}</label>

							<div class="col-md-6">
								<select id="club-country" class="custom-select @error('country') is-invalid @enderror" name="country" required autocomplete="country">
									<option value="">—</option>
									<option value="FR" @if (old('country', $club->country) == 'FR') {{ 'selected' }} @endif>France</option>
								</select>

								@error('country')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="club-registration_number" class="col-md-4 col-form-label text-md-right">{{ __('SIREN ou SIRET') }}</label>

							<div class="col-md-6">
								<input id="club-registration_number" type="text" class="form-control @error('registration_number') is-invalid @enderror" name="registration_number" value="{{ old('registration_number', $club->registration_number) }}" required autocomplete="on">

								@error('registration_number')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary">
									{{ __('Enregistrer') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
