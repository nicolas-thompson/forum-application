<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<script>
		window.App = {!! json_encode([
			'csrfToken' => csrf_token(),
			'user' => Auth::user(),
			'signedIn' => Auth::check()
		])!!};
	</script>

	<style>
		body { padding-bottom: 100px; }
		.level { display: flex; align-items: center; }
		.flex { flex: 1; }
		.mr-1 { margin-right: 1em; }
		.ml-a { margin-left: auto; }
		[v-cloak] { display:none; }
	</style>

	@yield('header')

</head>

<body style="padding-bottom: 100px">
	<div id="app">
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">

					<!-- Collapsed Hamburger -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<!-- Branding Image -->
					<a class="navbar-brand" href="{{ url('/') }}">
						{{ config('app.name', 'Laravel') }}
					</a>
				</div>
				@include('layouts.nav')
			</div>
		</nav>
		@yield('content')
		<flash message="{{ session('flash') }}"></flash>
	</div>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>