<script src="<?php echo get_template_directory_uri(); ?>/js/js.cookie.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/medium-zoom.min.js"></script>
<!-- <script src="<?php echo get_template_directory_uri(); ?>/js/swiper.min.js"></script> -->

<script src="<?php echo get_template_directory_uri(); ?>/js/javascript.js"></script>

<?php if(is_singular()) { ?>

<?php
$ads = get_field('horizontal_ads', 'option');
$ad = $ads[array_rand($ads)];
$adUrl = esc_url($ad['caption']);
$adImage = esc_url($ad['url']);
?>
<script>
var ad_html = '<div class="align-full ad-container"><span class="ad-label">Advertisement</span><a href="<?php echo $adUrl; ?>" target="_blank"><img src="<?php echo $adImage; ?>"></a></div>';
</script>

<script src="<?php echo get_template_directory_uri(); ?>/js/content-injector.js"></script>
<?php } ?>

<?php wp_footer(); ?>
</body>
</html>