<?php
/*
    Template Name: Contact
*/
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
    <header class="page-header">
        <?php if (has_post_thumbnail()): ?>
            <div class="bg" style="background-image: url(<?= get_the_post_thumbnail_url() ?>)"></div>
        <?php endif; ?>
        <div class="container">
            <h1><?php the_title(); ?></h1>
        </div>
    </header>
    <main>
        <section class="section thing">
            <div class="container booking-wrap">
                <div class="booking-wrap__left">
                    <h2>Where we are</h2>
                    <p>Situated in the quaint town of Holmfirth in West Yorkshire, near the borders of bother Lancashire and Derbyshire, we are either a short walk or drive away from everything you may need.</p>
                </div>
                <div class="booking-wrap__right">
                    <?php the_content(); ?>
                </div>
            </div>
        </section>
    </main>
<?php endwhile; ?>

<?php get_footer(); ?>
