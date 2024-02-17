<?php get_header(); ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <header>
            <h1><?php the_title(); ?></h1>
        </header>
        <main>
            <?php if (has_post_thumbnail()): ?>
                <figure>
        			<?php the_post_thumbnail('full'); ?>
    			    <?php if ( $caption = get_the_post_thumbnail_caption() ) : ?>
        				<figcaption><?php echo esc_html( $caption ); ?></figcaption>
                    <?php endif; ?>
            	</figure>
            <?php endif; ?>
            <?php the_content(); ?>
        </main>
    <?php endwhile; ?>
<?php get_footer(); ?>
