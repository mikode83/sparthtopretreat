@extends('layouts.app')

@section('content')
	@if (!have_posts())
		<div class="alert alert--warning alert--top-offset">
			{{ __('Sorry, no content was found.', 'sage') }}
		</div>
	@else
		@include('sections.content-archive')
	@endif
@endsection
