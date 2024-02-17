<div class="main-content">
	@if (have_posts())
		@while (have_posts())
			@php
				the_post();
				the_content();
			@endphp
		@endwhile
	@else
		<div class="default-padding container--medium">
			<h1 class="primary h1">{!! $title !!}</h1>
		</div>
	@endif
</div>

