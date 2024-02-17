@extends('layouts.app')

@section('content')
	@if (!have_posts())
		<p class="alert alert--fail">
			{{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}
		</p>
	@endif
@endsection
