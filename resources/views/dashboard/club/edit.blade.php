@extends('layouts.dashboard')

@section('quicklinks')
<a href="#club-edit">{{ __('Aller à la modification du club') }}</a>
<a href="#club-sports-list">{{ __('Aller à la liste des sport proposés') }}</a>
<a href="#club-sports-add">{{ __('Ajouter un sport proposé') }}</a>
@endsection

@section('hero')
<header class="hero">
	<h1 class="title">{{ $club->name }}</h1>
	<p class="subtitle">{!! __('Existe depuis <time datetime=":date_iso" title="Depuis le :date_formatted, pour être exact">:date_absolute</time>', ['date_iso' => $club->created_at->toIso8601String(), 'date_formatted' => $club->created_at->isoFormat('dddd D MMMM YYYY [à] HH[h]mm'), 'date_absolute' => $club->created_at->longAbsoluteDiffForHumans()]) !!}</p>
</header>
@endsection

@section('content')
<div class="columns-container">
	<section id="club-edit" class="column">
		<div class="card">
			<h2 class="card-header">{{ __('Modifier le club') }}</h2>

			<form method="POST" action="{{ route('club.update', ['club' => $club]) }}" class="card-body">
				@csrf

				<div class="form-group">
					<label for="club-name" class="label">{{ __('Nom') }}</label>

					<input id="club-name" type="text" class="input @error('name') is-invalid @enderror" name="name" value="{{ old('name', $club->name) }}" required autocomplete="organization">

					@error('name')
					<strong class="invalid-feedback" role="alert">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="club-address" class="label">{{ __('Adresse') }}</label>

					<textarea id="club-address" class="textarea @error('address') is-invalid @enderror" name="address" required autocomplete="street-address">{{ old('address', $club->address) }}</textarea>

					@error('address')
					<strong class="invalid-feedback" role="alert">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="club-city" class="label">{{ __('Ville') }}</label>

					<input id="club-city" type="text" class="input @error('city') is-invalid @enderror" name="city" value="{{ old('city', $club->city) }}" required autocomplete="city">

					@error('city')
					<strong class="invalid-feedback" role="alert">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="club-country" class="label">{{ __('Pays') }}</label>

					<select id="club-country" class="select @error('country') is-invalid @enderror" name="country" required autocomplete="country">
						<option value="">—</option>
						<option value="FR" @if (old('country', $club->country) == 'FR') {{ 'selected' }} @endif>{{ __('France') }}</option>
					</select>

					@error('country')
					<strong class="invalid-feedback" role="alert">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="club-registration_number" class="label">{{ __('SIREN ou SIRET') }}</label>

					<input id="club-registration_number" type="text" class="input @error('registration_number') is-invalid @enderror" name="registration_number" value="{{ old('registration_number', $club->registration_number) }}" required autocomplete="on">

					@error('registration_number')
					<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
					@enderror
				</div>

				<div class="form-group submit">
					<button type="submit" class="button">{{ __('Enregistrer') }}</button>
				</div>
			</form>
		</div>
	</section>

	<div class="column">
		@can('add_sport', $club)
		<form method="POST" action="{{ route('club.sports.add', ['club' => $club]) }}" id="club-sports-add" class="card">
			<h2 class="card-header">{{ __('Ajouter un sport') }}</h2>

			<div class="card-body">
				@csrf
				<div class="form-group">
					<label for="new-sport" class="label">{{ __('Nom du sport') }}</label>

					<select id="new-sport" class="select @error('sport_id') is-invalid @enderror" name="sport_id" value="{{ old('sport_id') }}" required autocomplete="off">
						<option value=""></option>
						@foreach($sports as $sport)
						<option value="{{ $sport->id }}">{{ $sport->name }}</option>
						@endforeach
					</select>

					@error('sport_id')
					<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
					@enderror
				</div>

				<div class="form-group submit">
					<button type="submit" class="button">{{ __('Enregistrer') }}</button>
				</div>
			</div>
		</form>
		@endcan

		<section id="club-sports-list" class="card">
			<h2 class="card-header">{{ __('Sports proposés') }}</h2>

			<div class="card-body">
				<p>{{ trans_choice('{0} L\'association ne propose aucun sport|{1} L\'association propose un seul sport|[2,*] L\'association propose :count sports', count($club->sports), ['count' => count($club->sports)]) }}</p>

				@foreach($club->sports as $sport)
				<form method="POST" action="{{ route('club.sports.remove', ['club' => $club, 'sport' => $sport]) }}" class="tag has-action">
					@csrf
					@method('DELETE')

					<span class="tag-content">{{ $sport->name }}</span>

					<input type="hidden" name="sport_id" value="{{ $sport->id }}">
					@can('remove_sport', $club)
					<button type="submit" class="tag-action is-danger">{{ __('Supprimer') }}</button>
					@endcan
				</form>
				@endforeach
			</div>
		</section>
	</div>
</div>
@endsection
