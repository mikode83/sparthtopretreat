<?php get_header(); ?>
    <header id="hp-header">
        <?php echo get_svg('str-roudle.svg'); ?>
        <?php echo get_svg('str-roudle.svg'); ?>
        <div class="hp__slick">
            <?php foreach ( get_field('slides') as $slide ): ?>
                <div class="item"><img src="<?= $slide['image']['url'] ?>" alt=""></div>
            <?php endforeach; ?>
        </div>
        <span class="container pre-intro"></span>
    </header>
    <main role="main">

        <section id="hp-intro" class="section">
            <div class="container light--bg intro">
                <div class="intro__text">
                    <?php the_content(); ?>
                    <p>
                        <a href="<?= home_url('/bookings/'); ?>" title="Book now" class="btn">Book Now</a>
                        <a href="<?= home_url('/gallery/'); ?>" title="Gallery" class="btn">Our Gallery</a>
                    </p>
                </div>
                <div class="intro__image align-center">
                    <div class="hp__scroller">
                        <?php foreach ( get_field('hp_scroller') as $slide ): ?>
                            <div class="item"><img src="<?= $slide['image']['url'] ?>" alt="Sparth Top Retreat"></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <div data-jarallax data-speed="0.1" class="jarallax" style="padding-bottom: 35%;">
            <img class="jarallax-img" src="<?= the_field('hp_parallax_image') ?>" alt="">
        </div>

        <section id="hp-continued" class="section">
            <?= get_svg('logo.svg'); ?>
            <div class="container additional_content">
                <div class="additional_content__text">
                    <?= the_field('hp_content'); ?>
                    <a href="<?= home_url('/our-hut/'); ?>" class="btn">What is a Shepards Hut?</a>
                </div>
            </div>
        </section>

    </main>
<?php get_footer(); ?>
