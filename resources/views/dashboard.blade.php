@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			@if (session('status'))
			<div class="alert alert-success" role="alert">
				{{ session('status') }}
			</div>
			@endif

			@empty($clubs)
			<div class="alert alert-warning" role="alert">
				Vous ne faites partie d'aucune association
			</div>
			@else
			@foreach($clubs as $club)
			<div class="card">
				<h2 class="card-header">{{ $club->name }}</h2>

				<div class="card-body">
					<p>Vous êtes membre depuis <time datetime="{{ $club->pivot->created_at->toIso8601String() }}" title="Depuis le {{ $club->pivot->created_at->isoFormat('dddd DD MMMM YYYY [à] HH[h]mm') }}, pour être exact">{{ $club->pivot->created_at->longAbsoluteDiffForHumans() }}</time>.</p>

					@if($club->pivot->is_owner)
					<p class="alert alert-success" role="alert">Vous êtes gérant de cette association.</p>
					@endif
				</div>
			</div>
			@endforeach
			@endempty
		</div>
	</div>
</div>
@endsection
