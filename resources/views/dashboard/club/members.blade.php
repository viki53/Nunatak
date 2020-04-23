@extends('layouts.dashboard')

@section('quicklinks')
<a href="#members-list">{{ __('Aller à la liste des membres') }}</a>
@can('invite_member', $club)
<a href="#club-invite-form">{{ __('Aller au formulaire d\'invitation') }}</a>
@endcan
@if(count($club->invitations))
<a href="#invitations-list">{{ __('Aller à la liste des invitations') }}</a>
@endif
@endsection

@section('hero')
<header class="hero">
	<h1 class="title">{{ $club->name }}</h1>
	<p class="subtitle">{!! __('Gestion des <a href=":href_list">membres</a> et <a href=":href_invitations">invitations</a>.', ['href_list' => '#members-list', 'href_invitations' => '#invitations-list']) !!} <a href="#club-invite-form">{{ __('Inviter un sportif') }}</a></p>
</header>
@endsection

@section('content')
<div class="columns-container">
	@if(count($club->members) > 0)
	<div class="column col-md-8">
		<div class="card" id="members-list">
			<h2 class="card-header">{{ trans_choice('{0} Aucun membre inscrit|{1} Un membre inscrit|[2,*] :count membres inscrits', count($club->members), ['count' => count($club->members)]) }}</h2>

			<div class="card-body">
				<div class="table-container">
					<table class="simple striped">
						<thead>
							<tr>
								<th>{{ __('Identité') }}</th>
								<th class="text-center" style="max-width: 9rem">{{ __('Ancienneté') }}</th>
								@can('remove_member', $club)
								<th class="text-center" style="max-width: 7rem"></th>
								@endcan
							</tr>
						</thead>
						<tbody>
							@foreach($club->members as $member)
							<tr>
								<td>
									<p>
										<strong>{{ $member->name }}</strong>
									</p>

									<p>
										@if($member->id == $user->id)
										<span class="tag is-info" role="alert">{{ __('C\'est vous !') }}</span>
										@endif

										@if($member->pivot->is_owner)
										<span class="tag is-success" role="alert">{{ __('Gérant de l\'association') }}</span>
										@endif
									</p>
								</td>

								<td class="text-center">
									<p>{!! __('Membre depuis <time datetime=":date_iso" title="Depuis le :date_formatted, pour être exact">:date_absolute</time>', ['date_iso' => $member->pivot->created_at->toIso8601String(), 'date_formatted' => $member->pivot->created_at->isoFormat('dddd D MMMM YYYY [à] HH[h]mm'), 'date_absolute' => $member->pivot->created_at->longAbsoluteDiffForHumans()]) !!}</p>
								</td>

								@can('remove_member', $club)
								<td class="text-center">
									@if(!$member->pivot->is_owner && $member->id !== $user->id)
									<form method="POST" action="{{ route('club.members.remove', ['club' => $club, 'member' => $member->pivot->id]) }}">
										@csrf
										@method('DELETE')

										<input type="hidden" name="member_id" value="{{ $member->id }}">
										<button type="submit" class="button is-danger">{{ __('Supprimer') }}</button>
									</form>
									@endif
								</td>
								@endcan
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	@endif

	<div class="column col-md-4">
		@can('invite_member', $club)
		<form method="POST" action="{{ route('club.invitations.add', ['club' => $club]) }}" id="club-invite-form" class="card">
			@csrf

			<h2 class="card-header">{{ __('Inviter un membre') }}</h2>

			<div class="card-body">
				<div class="form-group">
					<label for="new-member-name" class="label">{{ __('Nom') }}</label>

					<input id="new-member-name" type="text" class="input @error('user_name') is-invalid @enderror" name="user_name" id="club-invite-form-name" value="{{ old('user_name') }}" required autocomplete="name" placeholder="{{ __('Ex. : Hubert Bonisseur de la Bath') }}">

					@error('user_name')
					<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
					@enderror
				</div>

				<div class="form-group">
					<label for="new-member-email" class="label">{{ __('Adresse email') }}</label>

					<input id="new-member-email" type="email" class="input @error('user_email') is-invalid @enderror" name="user_email" value="{{ old('user_email') }}" required autocomplete="email" placeholder="{{ __('Ex. : oss117@').config('nunatak.root_domain') }}">

					@error('name')
					<strong class="invalid-feedback" role="alert">{{ $message }}</strong>
					@enderror
				</div>

				<div class="form-group submit">
					<button type="submit" class="button">{{ __('Ajouter') }}</button>
				</div>
			</div>
		</form>
		@endcan

		@foreach($club->invitations as $invitation)
		<div class="card">
			<h3 class="card-header"><em>{{ __('En attente :') }}</em> {{ $invitation->user_name }}</h3>

			<div class="card-body">
				<p>{{ $invitation->user_email }}</p>

				<p>{!! __('Invitation envoyée <time datetime=":date_iso" title="Le :date_formatted, pour être exact">:date_absolute</time>', ['date_iso' => $invitation->created_at->toIso8601String(), 'date_formatted' => $invitation->created_at->isoFormat('dddd D MMMM YYYY [à] HH[h]mm'), 'date_absolute' => $invitation->created_at->diffForHumans()]) !!}</p>

				@can('invite_member', $club)
				<form method="POST" action="{{ route('club.invitations.remove', ['club' => $club, 'invitation' => $invitation]) }}" class="form-group submit">
					@csrf
					@method('DELETE')

					<input type="hidden" name="invitation_id" value="{{ $invitation->id }}">
					<button type="submit" class="button is-danger">{{ __('Supprimer') }}</button>
				</form>
				@endcan
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection
