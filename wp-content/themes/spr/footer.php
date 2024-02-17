    <footer>
        <div class="container footer-cols">
            <div class="footer-cols__item">
                <a href="<?= home_url(); ?>" class="logo">
            		<span><?= get_svg('logo.svg'); ?></span>
            		<span>Sparth Top<br />Retreat</span>
            	</a>
            </div>
            <div class="footer-cols__item">
                <h3>Information</h3>
                <?php
            		wp_nav_menu( [
            			'menu'				=> 'Primary',
            			'container'			=> '',
            		]);
            	?>
            </div>
            <div class="footer-cols__item">
                <h3>Follow Us</h3>
                <p>Follow us on our Facebook page and give us a like or comment...</p>
                <ul class="social-linx">
                    <li>
                        <a href="https://www.facebook.com/Sparth-Top-Retreat-100941155051893">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 426.4 82.5">
                                <path d="M33.4 13c-5 0-6.5 2.2-6.5 7.1v8.1h13.4L39 41.4H26.9v39.9H10.8V41.4H0V28.3h10.8v-7.9C10.8 7 16.2 0 31.1 0c3.1 0 6.3.2 9.4.6V13"/>
                                <path d="M41.4 53.1c0-14.8 7-26 21.8-26 8 0 12.9 4.1 15.3 9.3v-8.1h15.4v53.1H78.4v-8c-2.2 5.1-7.3 9.1-15.3 9.1-14.7 0-21.8-11.1-21.8-26m16.2.2c0 7.9 2.9 13.2 10.4 13.2 6.6 0 9.9-4.8 9.9-12.4v-5.4c0-7.6-3.4-12.4-9.9-12.4-7.5 0-10.4 5.2-10.4 13.2v3.8z"/>
                                <path d="M127.3 27.1c6.2 0 12.2 1.3 15.4 3.6l-3.6 11.4c-3.3-1.6-7-2.4-10.7-2.4-8.7 0-12.5 5-12.5 13.6v3.1c0 8.6 3.8 13.6 12.5 13.6 3.7 0 7.4-.9 10.7-2.5l3.6 11.4c-3.2 2.2-9.1 3.6-15.4 3.6-18.9 0-27.4-10.1-27.4-26.4v-2.5c0-16.3 8.5-26.5 27.4-26.5"/>
                                <path d="M144.8 56.8v-4.7c0-15.1 8.6-25 26.1-25 16.5 0 23.8 10 23.8 24.8v8.5h-33.8c.3 7.3 3.6 10.5 12.5 10.5 5.8 0 11.6-1.1 17.1-3.2l2.9 11c-4.2 2.2-12.9 3.9-20.6 3.9-20.4-.1-28-10.2-28-25.8m16.1-7h19.4v-1.3c0-5.8-2.3-10.4-9.4-10.4-7.2 0-10 4.6-10 11.7"/>
                                <path d="M254.3 56.5c0 14.8-7.1 26-21.9 26-8 0-13.6-4-15.8-9.1v8h-15.2V1.6L217.5.2v35.5c2.3-4.7 7.5-8.5 15-8.5 14.7 0 21.9 11.1 21.9 26m-16.2-.4c0-7.5-2.9-13.1-10.6-13.1-6.6 0-10.1 4.7-10.1 12.3v5.6c0 7.6 3.6 12.3 10.1 12.3 7.7 0 10.6-5.6 10.6-13.1v-4z"/>
                                <path d="M259.6 56.1v-2.7c0-15.3 8.7-26.3 26.4-26.3s26.4 11 26.4 26.3v2.7c0 15.3-8.7 26.3-26.4 26.3s-26.4-10.9-26.4-26.3m36.8-3.8c0-7-2.9-12.6-10.4-12.6s-10.4 5.6-10.4 12.6v5c0 7 2.9 12.6 10.4 12.6s10.4-5.6 10.4-12.6v-5z"/>
                                <path d="M317.9 56.1v-2.7c0-15.3 8.7-26.3 26.4-26.3s26.4 11 26.4 26.3v2.7c0 15.3-8.7 26.3-26.4 26.3s-26.4-10.9-26.4-26.3m36.8-3.8c0-7-2.9-12.6-10.4-12.6s-10.4 5.6-10.4 12.6v5c0 7 2.9 12.6 10.4 12.6s10.4-5.6 10.4-12.6v-5z"/>
                                <path d="M392.8 53.6l15.9-25.4h17l-16.6 26.3 17.3 26.9h-17.1l-16.5-26v26h-16V1.6l16-1.5"/>
                            </svg>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="">
                            <svg class="instagram social-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 169.1 169.1">
                                <path d="M38.2 0C17.2.1.1 17.2 0 38.2v92.6C.1 151.9 17.2 169 38.2 169h92.6c21.1-.1 38.1-17.1 38.2-38.2V38.2c0-21-17.1-38.1-38.2-38.2H38.2zm46.3 125.9c-22.9 0-41.4-18.5-41.4-41.4s18.5-41.4 41.4-41.4 41.4 18.5 41.4 41.4-18.5 41.4-41.4 41.4zm51.7-80.5c-6.4 0-11.7-5.2-11.7-11.6 0-6.4 5.2-11.7 11.6-11.7 1.6 0 3.1.3 4.5.9 6 2.5 8.8 9.3 6.3 15.2-1.7 4.4-6 7.2-10.7 7.2z" />
                            </svg>
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
        <div class="container blurb">
            &copy; <?= date('Y'); ?> Sparth Top Retreat | <a href="<?= home_url('/privacy-policy/'); ?>">Privacy Policy</a>
        </div>
    </footer>
    <?php wp_footer();?>
	</body>
</html>
