<!--
@php
	// print_r($block);
@endphp
-->
<div id="{{ $block['id'] }}" class="{{ $block['classes'] }}">
	<div class="container--1100">
		<h2>{{ the_field('test') }}</h2>
		@if (get_field('show_posts'))
			@include('blocks.example.inc.latest-posts')
		@endif
		@if ($slides = get_field('slides'))
			<div class="swiper example-swiper">
				<div class="swiper-wrapper">
					@foreach ($slides as $slide)
						<div class="swiper-slide">{!! $slide['text'] !!}</div>
					@endforeach
				</div>
				<div class="swiper-pagination"></div>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>
		@endif
	</div>
</div>
