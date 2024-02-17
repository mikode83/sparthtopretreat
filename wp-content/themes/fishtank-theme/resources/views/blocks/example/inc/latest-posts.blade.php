@if (is_admin() || is_preview())
	<div class="posts-grid">
		<a href="#">
			<h3>Blog Post Title</h3>
		</a>
		<a href="#">
			<h3>Blog Post Title</h3>
		</a>
		<a href="#">
			<h3>Blog Post Title</h3>
		</a>
	</div>
@else
	@if ($latest_posts->have_posts())
		<div class="posts-grid">
			@while ($latest_posts->have_posts())
				@php $latest_posts->the_post() @endphp
				<a href="{{ get_the_permalink() }}">
					<h3>{{ the_title() }}</h3>
				</a>
			@endwhile
		</div>
	@endif
@endif
