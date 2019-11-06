@extends('layouts.app')

@section('content')
<header class="container">
	<h1>{{ $club->name }}</h1>
	<p class="lead">
		{{ trans_choice('{0} Aucun membre inscrit|{1} Un membre inscrit|[2,*] :count membres inscrits', count($club->members), ['count' => count($club->members)]) }} | {{ trans_choice('{0} Aucun membre en attente|{1} Un membre en attente|[2,*] :count membres en attente', count($club->pending_members), ['count' => count($club->pending_members)]) }}
	</p>
</header>

<div class="container">
	<div class="row">
		@include('club.menu', ['club' => $club])
		<div class="col-md-9">
			@foreach($club->members as $member)
			<div class="card mb-3">
				<h2 class="card-header">{{ $member->name }}</h2>

				<div class="card-body">
					@if(!$member->pivot->is_owner && $member->id !== $user->id)
					<form method="POST" action="{{ route('club.members.remove', ['club' => $club]) }}">
						@csrf
						@method('DELETE')

						<input type="hidden" name="member_id" value="{{ $member->id }}">
						<button type="submit" class="btn btn-outline-danger float-right">{{ __('Supprimer') }}</button>

						<p>Membre depuis <time datetime="{{ $member->pivot->created_at->toIso8601String() }}" title="Depuis le {{ $member->pivot->created_at->isoFormat('dddd DD MMMM YYYY [à] HH[h]mm') }}, pour être exact">{{ $member->pivot->created_at->longAbsoluteDiffForHumans() }}</time>.</p>
					</form>
					@endif

					@if($member->pivot->is_owner)
					<p class="alert alert-success" role="alert">Gérant de l'association.</p>
					@endif

					@if($member->id == $user->id)
					<p class="alert alert-info" role="alert">C'est vous !</p>
					@endif
				</div>
			</div>
			@endforeach

			@foreach($club->pending_members as $pending_member)
			<div class="card mb-3">
				<h2 class="card-header"><em>En attente :</em> {{ $pending_member->user_name }}</h2>

				<div class="card-body">
					<p>{{ $pending_member->user_email }}</p>

					<form method="POST" action="{{ route('club.pending_members.remove', ['club' => $club]) }}">
						@csrf
						@method('DELETE')

						<input type="hidden" name="invitation_id" value="{{ $pending_member->id }}">
						<button type="submit" class="btn btn-outline-danger float-right">{{ __('Supprimer') }}</button>

						<p>Ajouté <time datetime="{{ $pending_member->created_at->toIso8601String() }}" title="Le {{ $pending_member->created_at->isoFormat('dddd DD MMMM YYYY [à] HH[h]mm') }}, pour être exact">{{ $pending_member->created_at->diffForHumans() }}</time>.</p>
					</form>
				</div>
			</div>
			@endforeach

			<form method="POST" action="{{ route('club.pending_members.add', ['club' => $club]) }}" class="card">
				@csrf

				<h2 class="card-header">Inviter un membre</h2>

				<div class="card-body">
					<div class="form-group row">
						<label for="new-member-name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

						<div class="col-md-6">
							<input id="new-member-name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required autocomplete="name">

							@error('user_name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<label for="new-member-email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse email') }}</label>

						<div class="col-md-6">
							<input id="new-member-email" type="email" class="form-control @error('user_email') is-invalid @enderror" name="user_email" value="{{ old('user_email') }}" required autocomplete="email">

							@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">
								{{ __('Ajouter') }}
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
