@extends('layouts.dashboard')

@section('quicklinks')
<a class="sr-only sr-only-focusable" href="#members-list">{{ __('Aller à la liste des membres') }}</a>
<a class="sr-only sr-only-focusable" href="#invitations-list">{{ __('Aller à la liste des invitations') }}</a>
@endsection

@section('content')
<header class="hero">
	<h1 class="title">{{ $club->name }}</h1>
	<p class="subtitle">{!! __('Gestion des <a href="#members-list">membres</a> et <a href="#invitations-list">invitations</a>.') !!} <a href="#club-invite-form">{{ __('Inviter un sportif') }}</a></p>
</header>

<div class="columns-container">
	<div class="column">
		<h2 id="members-list">{{ trans_choice('{0} Aucun membre inscrit|{1} Un membre inscrit|[2,*] :count membres inscrits', count($club->members), ['count' => count($club->members)]) }}</h2>

		@if(count($club->members) > 0)
		<table class="simple striped">
			<thead>
				<tr>
					<th>Identité</th>
					<th>Ancienneté</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($club->members as $member)
				<tr>
					<td>
						<p><strong>{{ $member->name }}</strong></p>

						@if($member->id == $user->id)
						<p class="alert alert-info" role="alert">C'est vous !</p>
						@endif

						@if($member->pivot->is_owner)
						<p class="alert alert-success" role="alert">Gérant de l'association</p>
						@endif
					</td>

					<td>
						<p>Membre depuis <time datetime="{{ $member->pivot->created_at->toIso8601String() }}" title="Depuis le {{ $member->pivot->created_at->isoFormat('dddd DD MMMM YYYY [à] HH[h]mm') }}, pour être exact">{{ $member->pivot->created_at->longAbsoluteDiffForHumans() }}</time>.</p>
					</td>

					<td>
						@if(!$member->pivot->is_owner && $member->id !== $user->id)
						<form method="POST" action="{{ route('club.members.remove', ['club' => $club, 'member' => $member->pivot->id]) }}">
							@csrf
							@method('DELETE')

							<input type="hidden" name="member_id" value="{{ $member->id }}">
							<button type="submit" class="btn btn-outline-danger float-right">{{ __('Supprimer') }}</button>

							<p>Membre depuis <time datetime="{{ $member->pivot->created_at->toIso8601String() }}" title="Depuis le {{ $member->pivot->created_at->isoFormat('dddd DD MMMM YYYY [à] HH[h]mm') }}, pour être exact">{{ $member->pivot->created_at->longAbsoluteDiffForHumans() }}</time>.</p>
						</form>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@endif
	</div>

	<div class="column">
		@if(count($club->invitations) > 0)
		<h2 id="invitations-list">{{ trans_choice('{0} Aucune invitation en attente|{1} Une invitation en attente|[2,*] :count invitations en attente', count($club->invitations), ['count' => count($club->invitations)]) }}</h2>
		@foreach($club->invitations as $invitation)
		<div class="card mb-3">
			<h3 class="card-header"><em>En attente :</em> {{ $invitation->user_name }}</h3>

			<div class="card-body">
				<p>{{ $invitation->user_email }}</p>

				<form method="POST" action="{{ route('club.invitations.remove', ['club' => $club, 'invitation' => $invitation]) }}">
					@csrf
					@method('DELETE')

					<input type="hidden" name="invitation_id" value="{{ $invitation->id }}">
					<button type="submit" class="btn btn-outline-danger float-right">{{ __('Supprimer') }}</button>

					<p>Ajouté <time datetime="{{ $invitation->created_at->toIso8601String() }}" title="Le {{ $invitation->created_at->isoFormat('dddd DD MMMM YYYY [à] HH[h]mm') }}, pour être exact">{{ $invitation->created_at->diffForHumans() }}</time>.</p>
				</form>
			</div>
		</div>
		@endforeach
		@endif

		<form method="POST" action="{{ route('club.invitations.add', ['club' => $club]) }}" id="club-invite-form" class="card">
			@csrf

			<h2 class="card-header">Inviter un membre</h2>

			<div class="card-body">
				<div class="form-group">
					<label for="new-member-name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

					<div class="col-md-6">
						<input id="new-member-name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" id="club-invite-form-name" value="{{ old('user_name') }}" required autocomplete="name">

						@error('user_name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>

				<div class="form-group">
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

				<div class="form-group submit">
					<button type="submit" class="button-primary">
						{{ __('Ajouter') }}
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
