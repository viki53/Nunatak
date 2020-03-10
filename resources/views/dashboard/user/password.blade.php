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
				<h2 class="card-header">{{ __('Changer de mot de passe') }}</h2>

				<div class="card-body">
					<form method="POST" action="{{ route('user.password') }}">
						@csrf


						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

							<div class="col-md-6">
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" autofocus>

								@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmer le mot de passe') }}</label>

							<div class="col-md-6">
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

								@error('password_confirmation')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary">
									{{ __('Changer de mot de passe') }}
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