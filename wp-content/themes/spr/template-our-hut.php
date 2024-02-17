<?php
/*
    Template Name: Our Hut
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
        <section class="section">
            <div class="container our-hut-wrap">
                <div class="our-hut-wrap__left">
                    <h2>What is a Shepards Hut?</h2>
                </div>
                <div class="our-hut-wrap__right">
                    <?php the_field('what_is_a_shepards_hut'); ?>
                </div>
            </div>
        </section>

        <div data-jarallax data-speed="0.1" class="jarallax" style="padding-bottom: 35%;">
            <img class="jarallax-img" src="<?php the_field('hut_image'); ?>" alt="Sparth Top Retreat">
        </div>

        <section class="section" id="facilities">
            <?= get_svg('logo.svg'); ?>
            <div class="container our-hut-wrap">
                <div class="our-hut-wrap__left">
                    <h2>Our Facilities</h2>
                    <p>Here is a list of our facilities but if you want to see in and around the hut why not go through our gallery...</p>
                    <a href="<?= home_url('/gallery/'); ?>" class="btn">Our Gallery</a>
                </div>
                <div class="our-hut-wrap__right">
                    <?php $facilities = get_field('facilities'); ?>
                    <ul class="facilities">
                        <?php foreach ($facilities as $facility ): ?>
                            <li><?= $facility['item']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>

        <?php the_content(); ?>
    </main>
<?php endwhile; ?>

<?php get_footer(); ?>
