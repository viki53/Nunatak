@extends('layouts.app')

@section('content')
<header class="container">
	<h1>{{ __('Bienvenue, :name', ['name' => $user->name]) }}</h1>
	<p class="lead">
		{{ trans_choice('{0} Aucune invitation en attente|{1} Une invitation en attente|[2,*] :count invitations en attente', count($user->invitations), ['count' => count($user->invitations)]) }}
	</p>
</header>

<div class="container">
	@if (session('status'))
	<div class="alert alert-success" role="alert">
		{{ session('status') }}
	</div>
	@endif

	<div class="row">
		@include('user.menu', ['user' => $user])
		<div class="col-md-9">
			@foreach($user->invitations as $invitation)
			<div class="card mb-3">
				<h2 class="card-header">{{ $invitation->club->name }}</h2>

				<div class="card-body">
					<form method="POST" action="{{ route('user.invitations.accept', ['invitation' => $invitation]) }}" class="float-right ml-2">
						@csrf
						@method('POST')

						<button type="submit" class="btn btn-outline-success">{{ __('Accepter') }}</button>
					</form>

					<form method="POST" action="{{ route('user.invitations.reject', ['invitation' => $invitation]) }}" class="float-right ml-2">
						@csrf
						@method('DELETE')

						<button type="submit" class="btn btn-outline-danger">{{ __('Refuser') }}</button>
					</form>

					<p>Depuis <time datetime="{{ $invitation->created_at->toIso8601String() }}" title="Le {{ $invitation->created_at->isoFormat('dddd DD MMMM YYYY [à] HH[h]mm') }}, pour être exact">{{ $invitation->created_at->longAbsoluteDiffForHumans() }}</time>.</p>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection
