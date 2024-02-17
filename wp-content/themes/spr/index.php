<?php get_header(); ?>

    <header>
        <?php if (is_archive()): ?>
            <h1><?= single_cat_title(); ?></h1>
        <?php else: ?>
            <h1>Blog</h1>
        <?php endif; ?>
    </header>

    <main role="main">
        <?php if ( have_posts() ): ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article <?php post_class() ?>>
                    <a href="<?php the_permalink(); ?>" title="<?= the_title(); ?>">
                        <h3><?= the_title(); ?> </h3>
                        <time><?= get_the_date('d.m.Y') ?></time>
                        <?php the_excerpt(); ?>
                    </a>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>
    </main>

<?php get_footer(); ?>
