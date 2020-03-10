@extends('layouts.dashboard')
<!-- dash club -->

@section('content')
<!-- dash club content -->
<div class="container">
	<div class="row">
		<aside class="col-md-3 mb-3">
			@include('layouts.includes.club-sidebar')
			@yield('sidebar')
			<!-- dash club sidebar -->
		</aside>

		<div class="col-md-9">
			<!-- dash club main -->
			@yield('main')
		</div>
	</div>
</div>
@endsection
