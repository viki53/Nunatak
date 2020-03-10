@extends('layouts.dashboard-club')

@section('quicklinks')
<a class="sr-only sr-only-focusable" href="#club-edit">{{ __('Aller à la modification du club') }}</a>
<a class="sr-only sr-only-focusable" href="#club-sports-list">{{ __('Aller à la liste des sport proposés') }}</a>
<a class="sr-only sr-only-focusable" href="#club-sports-add">{{ __('Ajouter un sport proposé') }}</a>
@endsection

@section('header')
<header class="container">
	<h1>{{ $club->name }}</h1>
	<p class="lead">Existe depuis <time datetime="{{ $club->created_at->toIso8601String() }}" title="Depuis le {{ $club->created_at->isoFormat('dddd DD MMMM YYYY [à] HH[h]mm') }}, pour être exact">{{ $club->created_at->longAbsoluteDiffForHumans() }}</time></p>
</header>
@endsection

@section('main')
<section id="club-edit" class="card mb-3">
	<h2 class="card-header">{{ __('Modifier le club sportif') }}</h2>

	<form method="POST" action="{{ route('club.update', ['club' => $club]) }}" class="card-body">
		@csrf

		<div class="form-group row">
			<label for="club-name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

			<div class="col-md-6">
				<input id="club-name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $club->name) }}" required autocomplete="organization">

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
</section>


<section id="club-sports-list">
	<header class="container">
		<h1>{{ __('Sports proposés') }}</h1>
		<p class="lead">L'association {{ trans_choice('{0} ne propose aucun sport|{1} propose un seul sport|[2,*] propose :count sports', count($club->sports), ['count' => count($club->sports)]) }}</p>
	</header>
	@foreach($club->sports as $sport)
	<div class="card mb-3">
		<h2 class="card-header">{{ $sport->name }}</h2>

		<div class="card-body">
			<form method="POST" action="{{ route('club.sports.remove', ['club' => $club, 'sport' => $sport]) }}">
				@csrf
				@method('DELETE')

				<input type="hidden" name="sport_id" value="{{ $sport->id }}">
				<button type="submit" class="btn btn-outline-danger float-right">{{ __('Supprimer') }}</button>

				<p>Ajouté <time datetime="{{ $sport->pivot->created_at->toIso8601String() }}" title="Le {{ $sport->pivot->created_at->isoFormat('dddd DD MMMM YYYY [à] HH[h]mm') }}, pour être exact">{{ $sport->pivot->created_at->diffForHumans() }}</time>.</p>
			</form>
		</div>
	</div>
	@endforeach
</section>

<section id="club-sports-add" class="card mb-3">
	<h2 class="card-header">Ajouter un sport</h2>

	<form method="POST" action="{{ route('club.sports.add', ['club' => $club]) }}" class="card-body">
		@csrf
		<div class="form-group row">
			<label for="new-sport" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

			<div class="col-md-6">
				<select id="new-sport" class="custom-select @error('sport_id') is-invalid @enderror" name="sport_id" value="{{ old('sport_id') }}" required autocomplete="off">
					<option value=""></option>
					@foreach($sports as $sport)
					<option value="{{ $sport->id }}">{{ $sport->name }}</option>
					@endforeach
				</select>

				@error('sport_id')
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
</section>
@endsection
