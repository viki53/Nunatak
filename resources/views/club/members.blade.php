@extends('layouts.app')

@section('content')
<header class="container">
	<h1>{{ $club->name }}</h1>
	<p class="lead">{{ trans_choice('{0} Aucun membre|{1} Un seul membre|[2,*] :count membres dans l\'association', $club->members_count, ['count' => $club->members_count]) }}</p>
</header>

<div class="container">
	<div class="row">
		@include('club.menu', ['club' => $club])
		<div class="col-md-9">
			@foreach($club->members as $member)
			<div class="card">
				<h2 class="card-header">{{ $member->name }}</h2>

				<div class="card-body">
					@if(!$member->pivot->is_owner && $member->id !== $user->id)
					<form method="POST" action="{{ route('club.members.remove', ['id' => $club->id]) }}">
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
		</div>
	</div>
</div>
@endsection
