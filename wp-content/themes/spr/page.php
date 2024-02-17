<?php get_header(); ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <header class="page-header">
            <?php if (has_post_thumbnail()): ?>
                <div class="bg" style="background-image: url(<?= get_the_post_thumbnail_url() ?>)"></div>
            <?php endif; ?>
            <div class="container">
                <h1><?php the_title(); ?></h1>
            </div>
        </header>
        <main class="container section">
            <?php the_content(); ?>
        </main>
    <?php endwhile; ?>
<?php get_footer(); ?>
