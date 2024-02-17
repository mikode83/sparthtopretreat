<?php
/*
    Template Name: Bookings
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
            <div class="container booking-wrap">
                <div class="booking-wrap__left">
                    <h2>How to book</h2>
                    <p>
                        We currently don't take online bookings but you can fill in our simple request form to begin the booking process.
                    </p>
                    <p>
                        Alternatively, you can message us directly via our Facebook page.
                    </p>
                    <p>
                        <a href="https://www.facebook.com/Sparth-Top-Retreat-100941155051893" target="_blank" class="btn">Our Facebook Page</a>
                    </p>
                </div>

                <div class="booking-wrap__right">
                    <form id="booking-form">
                        <h2>Booking Request Form</h2>
                        <h3>Your Details</h3>
                        <div class="form-row halfer">
                            <div class="half">
                                <input type="text" name="fname" value="" placeholder="First Name"required>
                            </div>
                            <div class="half">
                                <input type="text" name="lname" value="" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="form-row halfer">
                            <div class="half">
                                <input type="email" name="email" value="" placeholder="Email Address" required>
                            </div>
                            <div class="half">
                                <input type="tel" name="telephone" value="" placeholder="Contact Number" required>
                            </div>
                        </div>
                        <h3>Reservation Details</h3>
                        <?php
                            $today = date('Y-m-d');
                        ?>
                        <div class="form-row halfer">
                            <div class="half">
                                <label for="">Arrival date</label>
                                <input type="date" name="arrival_date" value="" min="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="half">
                                <label for="">No. of Nights</label>
                                <select name="nights" id="nights">
                                    <option value="2">2 Nights</option>
                                    <option value="3">3 Nights</option>
                                    <option value="4">4 Nights</option>
                                    <option value="5">5 Nights</option>
                                    <option value="6">6 Nights</option>
                                    <option value="7">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <textarea name="comments" placeholder="Any special requirements and/or questions..."></textarea>
                        </div>
                        <div class="form-row align-right">
                            <input type="hidden" name="action" value="booking_form_ajax">
                            <button type="submit" name="button" class="btn">Submit</button>
                        </div>
                    </form>
                </div>


            </div>
        </section>

        <?php the_content(); ?>
    </main>
<?php endwhile; ?>

<?php get_footer(); ?>
