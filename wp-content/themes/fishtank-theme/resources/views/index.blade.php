@extends('layouts.app')

@section('content')
	@if (!have_posts())
		<p class="alert alert--fail">
			{{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}
		</p>
	@endif

	@while (have_posts())
		@php(the_post())
		@include('sections.content')
	@endwhile
@endsection
