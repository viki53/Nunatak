@extends('layouts.site', ['site' => $site])

@section('content')
<header class="container">
	<h1>{{ __('Page non trouvée') }}</h1>
	<p class="lead">{{ __('La page que vous recherchez n\'a pas été trouvée') }}.</p>
</header>
@endsection
