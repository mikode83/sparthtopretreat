<?php
/*
    Template Name: Things To Do
*/
$things_sections = get_field('things');
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
    <main class="thingys">
        <?php foreach ($things_sections as $thing): ?>
            <section class="section thing">
                <div class="container booking-wrap">
                    <div class="booking-wrap__left">
                        <h2><?= $thing['title']; ?></h2>
                        <p><?= $thing['intro']; ?></p>
                    </div>
                    <div class="booking-wrap__right">
                        <?php foreach ($thing['places'] as $place): ?>
                            <div class="thing-to-do">
                                <h3><?= $place['name'] ?></h3>
                                <p><?= $place['description'] ?></p>
                                <ul>
                                    <?php if (!empty($place['telephone'])): ?>
                                        <li class="telephone">
                                            <a href="tel:<?= str_replace( ' ', '', $place['telephone'] ); ?>"><?= $place['telephone']; ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (!empty($place['website'])): ?>
                                        <li class="website">
                                            <a target="_blank" href="<?= $place['website']; ?>">Website</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endforeach; ?>
    </main>
<?php endwhile; ?>

<?php get_footer(); ?>
