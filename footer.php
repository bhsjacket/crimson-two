<footer id="footer">
    <div class="footer-inner">
        <div class="footer-top">
            <div class="footer-left">
                <a href="<?php echo get_bloginfo('url'); ?>"><img class="footer-logo" src="<?php echo get_template_directory_uri(); ?>/assets/logos/logo-dark.svg"></a>
            </div>
            <div class="footer-right">
                <div class="footer-socials">
                    <a target="_blank" href="https://twitter.com/bhsjacket"><i class="fab fa-twitter"></i></a>
                    <a target="_blank" href="https://instagram.com/bhsjacket"><i class="fab fa-instagram"></i></a>
                    <a target="_blank" href="https://facebook.com/bhsjacket"><i class="fab fa-facebook-f"></i></a>
                    <a target="_blank" href="/feed"><i class="far fa-rss"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-left">
                <p class="footer-tagline">The Voice of the Students</p>
                <p aria-label="Cached <?php echo date('M d, Y g:i:s A T'); ?>" data-balloon-pos="up" class="footer-copyright">© 1912-<?php echo date('Y'); ?> Berkeley High Jacket</p>
            </div>
            <div class="footer-right">
                <ul class="footer-meta">
                    <li><a href="/about">About</a></li>
                    <li><a href="/about/contact">Contact</a></li>
                    <li><a href="/about/staff">Staff</a></li>
                    <li><a href="/about/staff/apply">Jobs</a></li>
                    <li><a href="/advertise">Advertise</a></li>
                </ul>
                <ul class="footer-legal">
                    <li><a href="/policies">Editorial Policies</a></li>
                    <li><a href="/policies/privacy-policy">Privacy Policy</a></li>
                    <li><a href="/login">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>



<?php get_template_part('load/foot'); ?>