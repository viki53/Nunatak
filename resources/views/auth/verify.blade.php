@extends('layouts.dashboard')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Valider votre adresse email') }}</div>

				<div class="card-body">
					@if (session('resent'))
						<div class="alert alert-success" role="alert">
							{{ __('Un nouveau lien de vérification a été envoyé à votre adresse email') }}
						</div>
					@endif

					<p>{{ __('Avant de continuer, veuillez vérifier que l'email n'est pas arrivé dans vos spams.') }}</p>

					<p>
						{{ __('Si vous n'avez pas reçu l'email') }},
						<form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
							@csrf
							<button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('cliquez ici pour en demander un nouveau') }}</button>.
						</form>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
