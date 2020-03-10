@extends('layouts.dashboard')

@section('content')
<header class="container">
	<h1>{{ __('Bienvenue, :name', ['name' => $user->name]) }}</h1>
</header>

<div class="container">
	<div class="row">
		@include('user.menu')
		<div class="col-md-9">
			<div class="card">
				<h2 class="card-header">{{ __('Modifier mon compte') }}</h2>

				<div class="card-body">
					<form method="POST" action="{{ route('user.profile') }}">
						@csrf

						<div class="form-group row">
							<label for="profile-name" class="col-md-4 col-form-label text-md-right">{{ __('Nom complet') }}</label>

							<div class="col-md-6">
								<input id="profile-name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

								@error('name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="profile-email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse email') }}</label>

							<div class="col-md-6">
								<input id="profile-email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="profile-phone" class="col-md-4 col-form-label text-md-right">{{ __('Numéro de téléphone') }}</label>

							<div class="col-md-6">
								<input id="profile-phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}" required autocomplete="tel">

								@error('phone')
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
