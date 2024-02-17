@if (!empty($cta_url))
	<a href="{{ $cta_url }}" {!! in_array($cta['type'], ['external', 'download']) ? ' target="_blank"' : '' !!} class="btn btn--{{ $cta['styling'] }}">
		<span class="btn__content">
			{!! $cta['text'] !!}
			@includeIf('SVG::btn-arrow-icon')
		</span>
	</a>
@endif
