@extends('layouts.app')

@section('content')
<header class="container">
	<h1>{{ $club->name }}</h1>
	<p class="lead">{{ trans_choice('{0} Aucun membre|{1} Un seul membre|[2,*] {1} membres dans l\'association', $club->members_count) }}</p>
</header>

<div class="container">
	@foreach($club->members as $member)
	<div class="card">
		<h2 class="card-header">{{ $member->name }}</h2>

		<div class="card-body">
			<p>Membre depuis <time datetime="{{ $member->pivot->created_at->toIso8601String() }}" title="Depuis le {{ $member->pivot->created_at->isoFormat('dddd DD MMMM YYYY [à] HH[h]mm') }}, pour être exact">{{ $member->pivot->created_at->longAbsoluteDiffForHumans() }}</time>.</p>

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
@endsection
