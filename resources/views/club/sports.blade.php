@extends('layouts.app')

@section('content')
<header class="container">
	<h1>{{ $club->name }}</h1>
	<p class="lead">L'association {{ trans_choice('{0} ne propose aucun sport|{1} propose un seul sport|[2,*] propose :count sports', count($club->sports), ['count' => count($club->sports)]) }}</p>
</header>

<div class="container">
	<div class="row">
		@include('club.menu', ['club' => $club])
		<div class="col-md-9">
			@if (session('status'))
			<div class="alert alert-success" role="alert">
				{{ session('status') }}
			</div>
			@endif

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

			<form method="POST" action="{{ route('club.sports.add', ['club' => $club]) }}" class="card">
				@csrf

				<h2 class="card-header">Ajouter un sport</h2>

				<div class="card-body">
					<div class="form-group row">
						<label for="new-sport" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

						<div class="col-md-6">
							<select id="new-sport" class="custom-select @error('sport_id') is-invalid @enderror" name="sport_id" value="{{ old('sport_id') }}" required autocomplete="off">
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
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
