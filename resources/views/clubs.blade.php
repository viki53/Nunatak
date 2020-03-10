@extends('layouts.dashboard')

@section('content')
<header class="container">
	<h1>{{ !empty($sport) ? $sport->name :__('Les associations') }}</h1>
	<p class="lead">{{ trans_choice('{0}Aucune association|{1}Une seule association|[2,*] :count associations', count($clubs), ['count' => count($clubs)]) }}</p>
</header>

<div class="container">
	@if (session('status'))
	<div class="alert alert-success" role="alert">
		{{ session('status') }}
	</div>
	@endif

	@empty($clubs)
	<div class="alert alert-warning" role="alert">
		Aucune association ne semble correspondre à votre recherche
	</div>
	@endempty

	@foreach($clubs as $club)
	<div class="card">
		<h2 class="card-header">{{ $club->name }}</h2>

		<div class="card-body">
			@empty($club->sports)
			<p>Ne propose aucun sport</p>
			@else
			<p>Propose :</p>
			<ul>
				@foreach($club->sports as $sport)
				<li><a href="{{ route('clubs').'/'.$sport->slug }}">{{ $sport->name }}</a></li>
				@endforeach
			</ul>
			@endempty
		</div>
	</div>
	@endforeach
</div>
@endsection
