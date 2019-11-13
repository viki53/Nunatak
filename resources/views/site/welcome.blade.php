@extends('layouts.site', ['site' => $site])

@section('content')
<header class="container">
	<h1>{{ __('Bienvenue sur le site de :name', ['name' => $site->club->name]) }}</h1>
	<p class="lead">Une association basée à {{ $site->club->city }}</p>
</header>
@endsection
