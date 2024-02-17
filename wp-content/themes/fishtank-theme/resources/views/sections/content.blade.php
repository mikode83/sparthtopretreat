<div class="main-content">
	@if (!empty(get_the_content()))
		@php
			the_content();
		@endphp
	@else
		<div class="default-padding container--medium">
			<h1 class="primary h1">{!! $title !!}</h1>
		</div>
	@endif
</div>
