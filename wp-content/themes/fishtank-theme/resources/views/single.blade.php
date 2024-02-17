@extends('layouts.app')

@section('content')
	@while (have_posts())
		@php(the_post())
		<div class="container--1100">
			<h1>{!! get_the_title() !!}</h1>
			@include('sections.content')
		</div>
	@endwhile
@endsection
