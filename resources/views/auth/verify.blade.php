@extends('layouts.public')

@section('content')
<div class="container small">
	<div class="card">
		<h1 class="card-header">{{ __('Valider votre adresse email') }}</h1>

		<div class="card-body">
			@if (session('resent'))
			<div class="alert is-success" role="alert">
				{{ __('Un nouveau lien de vérification a été envoyé à votre adresse email') }}
			</div>
			@endif

			<p>{{ __('Avant de continuer, veuillez vérifier que l\'email n\'est pas arrivé dans vos spams.') }}</p>

			<form method="POST" action="{{ route('verification.resend') }}">
				@csrf

				<p>
					{{ __('Si vous n\'avez pas reçu l\'email') }},
					<button type="submit" class="button is-link">{{ __('cliquez ici pour en demander un nouveau') }}</button>.
				</p>
			</form>
		</div>
	</div>
</div>
@endsection
