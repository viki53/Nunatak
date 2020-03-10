@extends('layouts.site', ['site' => $site, 'page' => $page])

@section('main')
<header class="container">
	<h1>{{ $page->last_revision->title }}</h1>
	@if(!empty($page->last_revision->subtitle))
	<p class="lead">{{ $page->last_revision->subtitle }}</p>
	@endif
</header>

<main class="container">
	{!! $page->last_revision->content !!}
</main>
@endsection
